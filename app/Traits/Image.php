<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use App\Models\Image as ImageModel;
use Intervention\Image\Facades\Image as Images;

trait Image
{

    /***
     * @param $imageName
     * @return bool
     */
    public function imageDeleteToPublic($imageName,$images)
    {
        $thumb = public_path($images['path'].'\thumb\\').$imageName;

        $img = public_path($images['path']) . $imageName;

        return File::delete(["$thumb", "$img"]);
    }

    public function saveImage($dates,$configs,$name)
    {

        if(!$configs) $configs  = isset(self::$configs['images'])?self::$configs['images']:false;

        if ($configs) {
                if (isset($configs['multiple']) && $configs['multiple'] && isset($dates[$name]) && is_array($dates[$name])) {
                    foreach ($dates[$name] as $data) {
                        $this->image_upload($data, $name, $configs);
                    }
                } else {
                    if(is_array($dates) && isset($dates[$name]))
                        $this->image_upload($dates[$name], $name, $configs);
                    else if(!is_array($dates)) $this->image_upload($dates, $name, $configs);
                }
        }
        return true;
    }

    public function image_upload($data, $name, $images, $alt = null, $title = null)
    {

        $_data = [
            'model' => self::$configs['model'],
            'item_id' => $this->id,
            'type' => $name,
            'name' => $this->imageUploadToPublic($data, $images),
            'alt' => $alt,
            'title' => $title,
            'sorting' => 0,
        ];

        if (isset($images['multiple']) && $images['multiple']) {
            $item = null;
        } else {
            $item = ImageModel::query()->where([['model',$_data['model']],
                ['item_id', $_data['item_id']],
                ['type', $_data['type']]])->first();
            if ($item) {
                $this->imageDeleteToPublic($item->name,$images);
            }
        }

        ImageModel::_save($_data, $item);
        return true;
    }


    /***
     * @param $request
     * @param $images
     * @param null $imageName
     * @return int|mixed|string|null
     */
    public function imageUploadToPublic($request, $images, $imageName = null)
    {

        $image = $request;

        if ($image) {
            if (!$imageName) {
                $imageName = (microtime(true)*1000) . '.' . $image->getclientoriginalextension();
            }
            $imageName = str_replace(' ', '-', $imageName);
            $upload_image = $image->move(public_path($images['path']), $imageName);
            // resizing an uploaded file
            try {
                if ($upload_image) {
                    if (isset($images['size'])) {
                        Images::make(public_path($images['path']) . $imageName)
                            ->resize($images['size'][0] ?? null, $images['size'][1] ?? null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->save(public_path($images['path']) . $imageName);
                    }
                    if (isset($images['thumbSize'])) {
                        $path = public_path($images['path'] . '/thumb/');
                        if (!file_exists($path)) mkdir($path, 0775, true);
                        Images::make(public_path($images['path']) . $imageName)
                            ->crop($images['thumbSize'][0] ?? null, $images['thumbSize'][1] ?? null /*,function ($constraint) {
                                $constraint->aspectRatio();
                            }*/)->save($path . $imageName);
                    }
                    return $imageName;
                } else {
                    return 0;
                }
            } catch (\Exception $exception) {
                if (!file_exists(public_path($images['path']))) mkdir(public_path($images['path']), 0775, true);
                copy(public_path($images['path']) . $imageName, public_path($images['path']) . $imageName);
                return $imageName;
            }
        } else {
            return 0;
        }
    }


//    public function imageType($id, $type, $multi)
//    {
//        $images = ImageModel::query()->addSelect(['_key' => function ($q) use ($id) {
//            $q->select('key')->from('images')->where('id', $id)->limit(1);
//        }])->addSelect(['_image_key' => function ($q) use ($id) {
//            $q->select('image_key')->from('images')->where('id', $id)->limit(1);
//        }])->havingRaw('images.key = _key AND images.image_key = _image_key')->get();
//        if (!$multi) {
//            $image = ImageModel::query()->findOrFail($id);
//            $image->type = $type;
//            $image->save();
//        }
//        return redirect()->back();
//    }


    public function imageDestroy($id)
    {
        if(isset(self::$configs['images'])){
            $image = ImageModel::query()->where('model',self::$configs['model'])->findOrFail($id);
            if(isset(self::$configs['images'][$image->type])){
                $model = new self();
                $model->imageDeleteToPublic($image->name,self::$configs['images'][$image->type]);
                $image->delete();
            }
        }

        return redirect()->back();
    }

    public function imagesDestroy($id){
        $model =  new self();
        $images = ImageModel::query()->where([['model',self::$configs['model']],['item_id',$id]])->get();
        foreach ($images as $img){
             $model->imageDeleteToPublic($img->name,self::$configs['images'][$img->type]);
        }
        ImageModel::query()->whereIn('id',$images->pluck('id'))->delete();
        return true;
    }

    public function getPath($type,$name){
        return self::$configs['images'][$type]['path'].'/'.$name;
    }
    public function getPaths($type,$name,$path=false){
            if($path){
                return self::$configs['images'][$type]['path'].'/'.$path.'/'.$name;
            }else return self::$configs['images'][$type]['path'].$name;
    }
}
