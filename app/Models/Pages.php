<?php

namespace App\Models;

use App\Traits\ResourceModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Pages extends Model
{

    use ResourceModel;
    private $config_name = 'Pages';

    public function setUrlAttribute($value){

        if($value == null){
            $value = isset(request('name')[Languages::GetStaticSlug()])?Str::slug(request('name')[Languages::GetStaticSlug()]):mt_rand(1000,9999);
        }else{
            $value = Str::slug($value);
        }
        $uniq = '';
        do {
            $value = $value.$uniq;

            $uniq = mt_rand(1000,9999);
        } while (self::query()->where([['url',$value],['id','<>',$this->getAttribute('id')]])->exists());
        $this->attributes['url'] = $value;
    }

    public function childes(){
        return $this->hasMany(SubPages::class,'parent_id','id')->where('status',1);
    }
}
