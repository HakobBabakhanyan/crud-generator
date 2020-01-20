<?php

namespace App\Traits;

use App\Models\Languages;
use Illuminate\Support\Facades\DB;

trait  ResourceModel
{
    use Image, Files, Relationships;


    protected $casts = [];
    protected static $configs;

    public function __construct(array $attributes = [])
    {
        self::$configs = config('custom-config.crud.'.$this->config_name);
        $this->setCasts();
        parent::__construct($attributes);
    }

    private function setCasts()
    {
        foreach (self::$configs['column'] ?? [] as $column => $params) {
            if (isset($params['casts'])) {
                $this->casts[$column] = $params['casts'];
            }
        }
        return;
    }


    public function _save($data, $params, $model = null)
    {
        if (is_null($model)) {
            $model = new self();
        }

        foreach ($params['column'] as $column => $param) {
            if (isset($data[$column])) {
                $model->$column = $data[$column];
            } else {
                if (isset($param['default'])) {
                    $model->$column = $param['default'];
                } else {
                    $model->$column = null;
                }
            }
        }
        if (isset(self::$configs['relationships'])
            && self::$configs['relationships']
        ) {
            foreach (self::$configs['relationships'] as $name => $relationships)
            {
                if ($relationships['relationship'] == 'hasOne') {
                    $model->{$relationships['foreignKey']}
                        = isset($data[$relationships['foreignKey']])
                        ? $data[$relationships['foreignKey']] : null;
                }
            }
        }
        $model->save();

        if (isset(self::$configs['images']) && self::$configs['images']) {
            foreach (self::$configs['images'] as $attribute => $images) {
                if (isset($images['custom']) && $images['custom']) {
                    foreach ($images['custom'] as $k => $v) {
                        if (isset($v[$model->$k])) {
                            $images = $v[$model->$k];
                        }
                    }
                }
                $model->saveImage($data, $images, $attribute);
            }
        }

        if (isset(self::$configs['custom_files'])
            && self::$configs['custom_files']
        ) {
            foreach (self::$configs['custom_files'] as $key => $custom_files) {
                foreach ($custom_files as $k => $v) {
                    $custom_params_files = false;
                    if ($model->$key == $k && is_array($v)) {
                        $model->saveFile($data, $v);
                    }
                }
            }
        }
        if (!isset($custom_params_files) && isset(self::$configs['files'])
            && self::$configs['files']
        ) {
            $model->saveFile($data, self::$configs['files']);
        }


        return $model;
    }

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function __get($name)
    {

        if ($this->casts && isset($this->casts[$name])) {
            if (isset(self::$configs['column'])
                && isset(self::$configs['column'][$name])
                && isset(self::$configs['column'][$name]['translate'])
                && self::$configs['column'][$name]['translate']
            ) {
                $name = json_decode($this->getAttribute($name), true);
                return config('language') && isset($name[config('language')])
                    ? $name[config('language')]
                    : (isset($name[Languages::GetStaticSlug()])
                        ? $name[Languages::GetStaticSlug()]
                        : (is_array($name) ? array_shift($name) : null));
            }

        } elseif (isset(self::$configs['images'])
            && isset(self::$configs['images'][$name])
            && self::$configs['images'][$name]
        ) {
            $images = \App\Models\Image::query()->where([
                ['model', self::$configs['model']],
                ['item_id', $this->id], ['type', $name]
            ]);

            if (isset(self::$configs['images'][$name]['multiple'])
                && self::$configs['images'][$name]['multiple']
            ) {
                $multiple = true;
            }else {
                $multiple = false;
            }
            if (isset(self::$configs['images'][$name]['custom'])
                && self::$configs['images'][$name]['custom']
            ) {
                foreach (self::$configs['images'][$name]['custom'] as $k => $v)
                {
                    if (isset($v[$this->$k])) {
                        if (isset($v[$this->$k]['multiple'])
                            && $v[$this->$k]['multiple']
                        ) {
                            $multiple = true;
                        } else {
                            $multiple = false;
                        }
                    }
                }
            }
            if($multiple){
                return $images->get();
            } else
            return $images->first();
        } elseif (isset(self::$configs['files'])
            && isset(self::$configs['files'][$name])
            && self::$configs['files'][$name]
        ) {
            $files = \App\Models\Files::query()->where([
                ['model', self::$configs['model']],
                ['item_id', $this->id], ['type', $name]
            ]);

            if (isset(self::$configs['files'][$name]['multiple'])
                && self::$configs['files'][$name]['multiple']
            ) {
                return $files->get();
            } else {
                return $files->first();
            }
        }
        return parent::__get($name);
    }

    public function __call($name, $arguments)
    {
        if ($this->casts && isset($this->casts[$name])) {
            if (isset(self::$configs['column'])
                && isset(self::$configs['column'][$name])
                && isset(self::$configs['column'][$name]['translate'])
                && self::$configs['column'][$name]['translate']
            ) {
                $name = json_decode($this->getAttribute($name), true);
                return isset($name[$arguments[0]]) ? $name[$arguments[0]]
                    : null;
            }
        }
        return parent::__call($name, $arguments);

    }


    public function sortable($data)
    {
        $casesRaw = '';
        $sort = 1;
        $ids = [];
        if (is_array($data)) {
            foreach ($data as $item) {
                $id = $item;
                if ($id && !in_array($id, $ids)) {
                    $ids[] = $id;
                    $casesRaw .= ' WHEN `id`='.$id.' THEN '.$sort++;
                }
            }
        }
        if (!empty($ids)) {
            self::whereIn('id', $ids)->update([
                'sorting' => DB::raw('CASE'.$casesRaw.' END')
            ]);
            return true;

        }

        return false;
    }


}
