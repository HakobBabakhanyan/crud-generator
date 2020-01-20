<?php

namespace App;

use App\Traits\Image;
use App\Traits\ModelSave;
use App\Traits\Relations;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;

class Chameleon extends Model
{
    use ModelSave, Translate, Image, Relations {
        Translate::__get as private __getTranslate;
        Relations::__get as private __getRelation;
        ModelSave::__construct as private __constructModelSave;
    }

    function __get($name)
    {
        if(($attribute = $this->__getTranslate($name)) && !is_bool($attribute)){
            return $this->__getTranslate($name);
        }
        if(($attribute = $this->__getRelation($name)) && !is_bool($attribute)) {
            return $this->__getRelation($name);
        }
        return parent::__get($name);
    }
        protected static $tableName;

        public function __construct($value = null, array $attributes = array())
        {
            if($value){
                $this->table = $value;
                self::$tableName = $value;
            }else {
                $this->table = self::$tableName;
            }
            $this->__constructModelSave();
            parent::__construct($attributes);
        }
}
