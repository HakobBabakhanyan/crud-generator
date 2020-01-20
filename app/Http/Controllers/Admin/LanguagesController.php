<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Languages;
use App\Traits\Share;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    use Share;

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->admin_share();
            view()->share(['active_menu'=>'Languages']);
            return $next($request);
        });
    }

    public function list(){

        $data =[
            'items'=> Languages::all()
        ];

        return view('admin.pages.languages.index',$data);
    }

    public function create(){

        $data=[
            'action'=>'create'
        ];

        return view('admin.pages.languages.form',$data);
    }

    public function store(Request $request){

        $request->validate(['name'=>'required','slug'=>'required|unique:languages','image'=>'image']);

        Languages::_save($request->all());

        return redirect()->back();
    }

    public function update(Languages $language){

        $data=[
            'action'=>'update',
            'item'=>$language
        ];

        return view('admin.pages.languages.form',$data);
    }

    public function edit(Languages $language,Request $request){


        $request->validate(['name'=>'required','slug'=>'required|unique:languages,slug,'.$language->id,'image'=>'image']);

        Languages::_save($request->all(),$language);

        return redirect()->back();

    }


    public function delete(Languages $language){

        if(count($language->images)){
            foreach($language->images as $image){
                Languages::imageDeleteToPublic($image->name);
            }
        };
        $language->delete();
        return redirect()->back();
    }
}
