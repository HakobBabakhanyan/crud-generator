<?php

namespace App\Traits;


use App\Models\Languages;

trait Translate
{

    public function __get($attribute){
        if( isset(self::$info['translate']) && in_array($attribute, (array) self::$info['translate'])){
            $name = json_decode($this->getAttribute($attribute),true);
            config('language', Languages::GetStaticSlug());
            if(isset($name[config('language', Languages::GetStaticSlug())])){
                return $name[config('language', Languages::GetStaticSlug())];
            }elseif(isset($name[Languages::GetStaticSlug()])){
                return $name[Languages::GetStaticSlug()];
            }else {
                return (is_array($name))?array_shift($name):null;
            }
        }else{ return false;}
    }

    public function __call($name, $arguments)
    {
        if(isset(self::$info['translate']) && in_array($name, (array) self::$info['translate'])){
            $translate = json_decode($this->getAttribute($name),true);
            return (isset($translate[$arguments[0]]))?$translate[$arguments[0]]:null;
        }else{ return parent::__call($name, $arguments);}
    }

    public function __set($name, $value)
    {
        if(in_array($name, (array) self::$info['translate'])){
              $this->setAttribute($name,$this->asJson($value));
        }else{  parent::__set($name, $value);}
    }

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

}
