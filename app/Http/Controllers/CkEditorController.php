<?php

namespace App\Http\Controllers;

use App\Traits\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CkEditorController extends Controller
{

    private const path = [
        'image' => 'uploads/images/ck-editor/'
    ];

    public function upload_image(Request $request){

        $rules = [
            'upload' => 'required|mimes:jpeg,jpg,gif,png',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'uploaded' => 0,
                "error" => [
                    "message" => "Invalid image format"
                ]
            ], 200);
        }
        $imageName = $this->upload($request['upload']);
        if($imageName){
            return response()->json([
                'uploaded' => 1,
                'fileName' => $imageName,
                'url' => asset(self::path['image'].$imageName),
            ], 200);
        }else{
            return response()->json([
                'uploaded' => 0,
                "error" => [
                    "message" => "server error !"
                ]
            ], 200);
        }

    }

    public function upload($upload){
        $imageName = (time() * rand(1, 5)) . '.' . $upload->getclientoriginalextension();
        $upload_image = $upload->move(public_path(self::path['image']), $imageName);
        if($upload_image){
            return $imageName;
        }
        else return false;

    }
}


