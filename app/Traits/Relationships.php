<?php

namespace App\Traits;


trait Relationships{

    public function getRelationships($paramsName , $item){
        if(isset(self::$configs['relationships']) && isset(self::$configs['relationships'][$paramsName])){
            $related = new self::$configs['relationships'][$paramsName]['related'];
            if(self::$configs['model'] === self::$configs['relationships'][$paramsName]['related']){
                $related = $related->where('id','<>',$item->id);
            }
            return $related->get();
        }

        return null;
    }

    public function getRelationship($paramsName,$item){
        if(isset(self::$configs['relationships']) && isset(self::$configs['relationships'][$paramsName])){
            $related = new self::$configs['relationships'][$paramsName]['related'];
            $related = $related->where('id',$item->{self::$configs['relationships'][$paramsName]['foreignKey']})->get();
            return $related;
        }
    }

}
