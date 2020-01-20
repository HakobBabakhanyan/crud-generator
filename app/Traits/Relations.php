<?php

namespace App\Traits;
use App\Chameleon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait Relations
{

    use Sql;

    public $relation_many = [];
    private $references;

    private static $_getTableRelation;

    /***
     * @param null $table
     * @return array
     */
    public function getTableRelation($table=null){
        if(!isset(self::$_getTableRelation)){
            self::$_getTableRelation = DB::select('select * from INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = SCHEMA()  AND REFERENCED_TABLE_NAME IS NOT NULL AND TABLE_NAME = "'.(($table)?$table:$this->getTable()).'" ');
        }
        return self::$_getTableRelation;
    }

    /***
     * @return array|mixed
     */
    public function getTableRelationMany(){
        $relation = DB::select('select * from INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = SCHEMA()  AND REFERENCED_TABLE_NAME IS NOT NULL AND  REFERENCED_TABLE_NAME = "'.$this->getTable().'"');
        foreach ($relation as $rel){
            $column = $this->getTableInfo($rel->TABLE_NAME)->toArray();
            $c = array_column($column, 'COLUMN_KEY');

            if(count(array_filter($c))+3 >= count($column)){
                $relation_table_Name = deleteElementArray($this->getTable(),array_column($this->getQey($rel->TABLE_NAME), 'REFERENCED_TABLE_NAME'));
            }
        }
        return isset($relation_table_Name)?$relation_table_Name:array();
    }

    /***
     * @param null $TABLE_NAME
     * @return bool
     */
    public function getTableRelationManyQuery($TABLE_NAME = null){
        $relation = DB::select('select * from INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = SCHEMA()  AND REFERENCED_TABLE_NAME IS NOT NULL AND  REFERENCED_TABLE_NAME = "'.$TABLE_NAME.'"');
        foreach ($relation as $rel){
            $column = $this->getTableInfo($rel->TABLE_NAME)->toArray();
            $c = array_column($column, 'COLUMN_KEY');
            if(count(array_filter($c))+3 >= count($column)){
                if($rel->REFERENCED_TABLE_NAME == $TABLE_NAME){
                    $var = collect($column)->where('COLUMN_KEY','<>','')
                        ->where('COLUMN_NAME','<>','id')
                        ->where('COLUMN_NAME','<>',$rel->COLUMN_NAME);
                    if($var->isNotEmpty() && $var->first()){
                       return    $this->belongsToMany(new Chameleon($rel->REFERENCED_TABLE_NAME),$rel->TABLE_NAME, $var->first()->COLUMN_NAME,$rel->COLUMN_NAME);
                    }

                }
            }
        }
        return false;
    }

    /***
     * @param null $table
     * @return \Illuminate\Support\Collection
     */
    public function getTableInfo($table=null){
        $form = collect(DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "'.(($table)?$table:$this->getTable()).'"'));
        return $form;
    }

    /***
     *
     */
    public function relation(){
        foreach ($this->getTableRelation() as $relations) {
            $this->relations[$relations->REFERENCED_TABLE_NAME] = $this->hasMany(new Chameleon($relations->REFERENCED_TABLE_NAME), $relations->REFERENCED_COLUMN_NAME, $relations->COLUMN_NAME)->get();
        }
    }

    /***
     *
     */
    public function relationMany(){
        foreach($this->getTableRelationMany() as $table){
            $this->relation_many[$table] = $this->getTableRelationManyQuery($table)->get();
        }
    }
    /***
     * @return array
     */
    public function getReferenceTable(){
            return array_column($this->getTableRelation(), 'REFERENCED_TABLE_NAME');
    }

    /***
     * @param $attribute
     * @return bool
     */
    public function __get($attribute){
        if (in_array($attribute, $this->getReferenceTable())) {
            if (isset($this->references[$attribute]))
                return $this->references[$attribute];
        } else {
            return false;
        }
        return false;
    }

}
