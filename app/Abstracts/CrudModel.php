<?php

namespace App\Abstracts;

use App\Traits\Image;
use App\Traits\ModelSave;
use App\Traits\Relations;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;


abstract class CrudModel extends Model {

    use ModelSave, Translate, Image, Relations {
        Translate::__get as private __getTranslate;
        Relations::__get as private __getRelation;
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
}
