<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public static function _save($data,$item = null){
        if(!$item){
            $item = new  self();
        }

        $item->model = $data['model'];
        $item->item_id = $data['item_id'];
        $item->type = $data['type'];
        $item->name = $data['name'];
        $item->alt = $data['alt'];
        $item->title = $data['title'];
        $item->sorting = $data['sorting'];

        $item->save();

        return $item;


    }
}
