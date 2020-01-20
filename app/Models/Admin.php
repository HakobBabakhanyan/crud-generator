<?php

namespace App\Models;

use App\Notifications\ResetAdminPasswordNotification;
use App\Traits\Image;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use function PHPSTORM_META\type;

class Admin extends Authenticatable
{
    use Notifiable, Image;

    protected static $configs = [
        'model' => 'App\Models\Admin',
        'images'=>[
            'default'=>[
                'title'=>'image to default',
                'path'=>'images\admins\profile\\'
            ]
        ]
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetAdminPasswordNotification($token));
    }

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'type', 'image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function _save($data,$model){
        if(!$model){
            $model = new self();
        }
        $model->name = $data['name'];
        $model->email = $data['email'];
        if(isset($data['password'])){
            $model->password = bcrypt($data['password']);
        }
        if($model->save()){
            if(isset($data['image'])){
                $model->saveImage($data['image']);
            }
        }
    }

    public static function createOrUpdate($data, $id = null)
    {
        if ($id) {
            $model = self::find($id);
            $model->email = $data['email'];
            $model->name = $data['name'];
            if ($model->save()) {
                return $model;
            }
            return false;
        }

        return null;
    }


    public function getImageAttribute(){
        $image = \App\Models\Image::query()->where([['model',self::$configs['model']],['item_id',$this->id]])->first();
        return $image?self::$configs['images']['default']['path'] . $image->name:null;
    }

}
