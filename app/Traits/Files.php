<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use App\Models\Files as FilesModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

trait Files
{


    /**
     * @param $file_name
     * @param $files
     * @return bool
     */
    public function fileDelete($file_name,$files)
    {

        $file = public_path($files['path']) . $file_name;

        return File::delete($file);
    }

    public function saveFile($dates,$configs = null)
    {
        if(!$configs) $configs  = isset(self::$configs['files'])?self::$configs['files']:false;

        if ($configs) {
            foreach ($configs as $name => $files) {
                if (isset($files['multiple']) && $files['multiple'] && isset($dates[$name]) && is_array($dates[$name])) {
                    foreach ($dates[$name] as $data) {
                        $this->file_upload($data, $name, $files);
                    }
                } else {
                    if(is_array($dates) && isset($dates[$name]))
                        $this->file_upload($dates[$name], $name, $files);
                }
            }
        }
        return true;
    }

    public function file_upload($data, $name, $files, $title = null)
    {
        $dataFile = $this->file_upload_public($data,$files);
        $data = [
            'model' => self::$configs['model'],
            'item_id' => $this->id,
            'type' => $name,
            'name' => $dataFile['file'],
            'title' => $title??$dataFile['fileName'],
            'sorting' => 0,
        ];

        if (isset($files['multiple']) && $files['multiple']) {
            $item = null;
        } else {

            $item = FilesModel::query()->where([['model',$data['model']],
                ['item_id', $data['item_id']],
                ['type', $data['type']]])->first();
            if ($item) {
                $this->fileDelete($item->name,$files);
            }
        }

        FilesModel::_save($data, $item);

        return true;
    }


    /***
     * @param $file
     * @param $files
     * @return int|string|string[]
     */
    public function file_upload_public($file, $files)
    {

        $fileName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $name = (microtime(true)*1000) . '.' . $file->getclientoriginalextension();

        $file->move(public_path($files['path']), $name);

        return  [
            'file'=>$name,
            'fileName'=>$fileName
        ];

    }


    public function fileDestroy($id)
    {
        if(isset(self::$configs['files'])){
            $file = FilesModel::query()->where('model',self::$configs['model'])->findOrFail($id);
            if(isset(self::$configs['files'][$file->type])){
                $model = new self();
                $model->fileDelete($file->name,self::$configs['files'][$file->type]);
                $file->delete();
            }
        }

        return redirect()->back();
    }

//    public function imagesDestroy($id){
//        $model =  new self();
//        $images = ImageModel::query()->where([['model',self::$configs['model']],['item_id',$id]])->get();
//        foreach ($images as $img){
//             $model->imageDeleteToPublic($img->name,self::$configs['images'][$img->type]);
//        }
//        ImageModel::query()->whereIn('id',$images->pluck('id'))->delete();
//        return true;
//    }

    public function getFilePath($type,$name){
        return self::$configs['files'][$type]['path'].$name;
    }
}
