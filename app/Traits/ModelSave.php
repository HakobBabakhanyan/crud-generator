<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ModelSave{

    public  static $info = [];

    public function __construct()
    {
        $info = $this->getTableForm();
        if(empty(self::$info['translate'])){
            $translate = $info->map(function ($column,$key){
                $type = json_decode($column->COLUMN_COMMENT);
                if(isset($type->translate) && filter_var($type->translate, FILTER_VALIDATE_BOOLEAN)){
                    return $column->COLUMN_NAME;
                };
            })->reject(function ($name){
                return empty($name);
            })->toArray();
            self::$info['translate'] = $translate;
        };
        if(empty(self::$info['type'])){
            $editor = $info->mapWithKeys(function ($column,$key){
                $type = json_decode($column->COLUMN_COMMENT);
                if(isset($type->type) ){
                    return [$column->COLUMN_NAME => $type->type];
                }else return [$column->COLUMN_NAME => 'text'];
            })->toArray();
            self::$info['type'] = $editor;
        }
        if(empty(self::$info['column'])){
            $column = $info->map(function ($column,$key){
                $type = json_decode($column->COLUMN_COMMENT);
                if(isset($type->hide) && !filter_var($type->hide, FILTER_VALIDATE_BOOLEAN)){
                    return null;
                };
                return $column->COLUMN_NAME;
            })->reject(function ($name){
                return empty($name);
            })->toArray();
            self::$info['column'] = $column;
        }
        if(empty(self::$info['default'])){
            $default = $info->mapWithKeys(function ($column,$key){
                return [$column->COLUMN_NAME => $column->COLUMN_DEFAULT];
            })->toArray();
            self::$info['default'] = $default;
        }
        if(empty(self::$info['validate'])){
            $validate = $info->mapWithKeys(function ($column,$key){
                $validate = array();
                $type = json_decode($column->COLUMN_COMMENT);
                if($column->IS_NULLABLE === 'NO' && is_null($column->COLUMN_DEFAULT)){
                    array_push($validate,'required');
                }else array_push($validate,'nullable');
                $value = $column->DATA_TYPE;
                foreach (static::typeArray() as $key => $val) {
                    $value = str_replace($val, $key, $value);
                }
                array_push($validate,$value);
                if(isset($type->translate) && filter_var($type->translate, FILTER_VALIDATE_BOOLEAN)){
                    return [$column->COLUMN_NAME.'.*'=>$validate];
                } else return [$column->COLUMN_NAME=>$validate];
            })->reject(null)->toArray();

            self::$info['validate'] = $validate;
        }

        return parent::__construct();
    }


    protected static function typeArray()
    {
        static $charsArray;

        if (isset($charsArray)) {
            return $charsArray;
        }

        return $charsArray = [
            'string'=>['text','string'],
            'numeric'=>['int','bigint'],
        ];
    }

    /***
     * @param $data
     */
    public function save_hb($data){
        if(isset($this->data) && is_array($this->data)){
            foreach ($this->data as $key=>$item){
                if(is_string($key)){
                    $value = (explode('|',$key));
                }else $value =  (explode('|',$item));

                if(isset($value[1])){
                    if($value[1] == 'boolean'){
                        $this->{$value[0]} = (boolean) (isset($data[$value[0]])?$data[$value[0]]:null);
                    }else{
                        $this->{$value[0]} =(isset($data[$value[0]])?$data[$value[0]]:null);
                    }
                } else $this->{$value[0]} = (isset($data[$value[0]])?$data[$value[0]]:null);
            }
        }
    }

    public function _save_($data){
        foreach (self::$info['column'] as $column){
                $this->{$column} = isset($data[$column])?$data[$column]:self::$info['default'][$column];
        }
    }

    public function getInfoTable(){
        return DB::select('SHOW FULL COLUMNS FROM '.$this->getTable());
    }

    private static $_getTableForm;

    public function getTableForm(){
        if(!isset(self::$_getTableForm)){
            self::$_getTableForm = collect(DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "'.$this->getTable().'"'));
        }

        $relations = $this->getTableRelation(); ///
        $form = self::$_getTableForm->filter(function ($column) use ($relations){
            if(!in_array($column->COLUMN_NAME, array_column($relations, 'COLUMN_NAME')) && $column->EXTRA == '' && $column->COLUMN_NAME != $this::CREATED_AT && $column->COLUMN_NAME != $this::UPDATED_AT){
                return $column;
            }else return null;
        });
        return $form;
    }

    // Model

    public static function _save($data,$model){

        $model->_save_($data);
        $model->save();
        if ($model->img && isset($data['image'])) {
            $model->saveImage($data['image']);
        }
        foreach ($model->getTableRelation() as $table){
            if(isset($data[$table->REFERENCED_TABLE_NAME])){
                if(!is_array($data[$table->REFERENCED_TABLE_NAME])){
                    $model->{$table->COLUMN_NAME} = $data[$table->REFERENCED_TABLE_NAME];
                }
            }
        }
        foreach ($model->getTableRelationMany() as $table){
            $model->getTableRelationManyQuery($table)->sync(isset($data[$table])?$data[$table]:array());
        }
        $model->save();
        return $model;
    }




}
