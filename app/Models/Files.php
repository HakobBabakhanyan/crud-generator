<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    public static function _save($data,$item = null){
        if(!$item){
            $item = new  self();
        }

        $item->model = $data['model'];
        $item->item_id = $data['item_id'];
        $item->type = $data['type'];
        $item->name = $data['name'];
        $item->title = $data['title'];
        $item->sorting = $data['sorting'];
        try{
            $item->save();
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
        $item->save();

        return $item;


    }
}
