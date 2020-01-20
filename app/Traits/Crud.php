<?php

namespace App\Traits;


use App\Models\News;
use App\Chameleon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/***
 * Trait Crud
 * @package App\Traits
 */
trait Crud
{


    public function list($name)
    {
        $model = self::info['models'];
        $model = new $model;
        $data = [
            'items' => $model::all(),
            'model'=>$model,
            'route'=>$name,
        ];

        return view('admin.crud.index',$data);
    }

    public function create($name)
    {
        $model = self::info['models'];
        $model = new $model;

        $references= array();
        foreach ($model->getReferenceTable() as $table){
            $chameleon = new Chameleon($table);
            $references[$table] = $chameleon::query()->get();
        }
        $model->references = $references;
        $references_many= array();
        foreach ($model->getTableRelationMany() as $table){
            $chameleon = new Chameleon($table);
            $references_many[$table] = $chameleon::query()->get();
        }
        $model->references_many = $references_many;

        $data = [
            'action' => 'create',
            'model' =>$model,
            'route'=>$name,
        ];

        return view('admin.crud.form',$data);
//        return view(self::info['folder'] . '.form', $data);
    }

    public function store(Request $request)
    {
        $model = self::info['models'];
        $model = new $model;
        $validator = $model::$info['validate'];

        $request->validate($validator);
        $model::_save($request->all(),$model);

        return redirect()->back();
    }

    public function update(Request $request, $item,$name)
    {
        $model = self::info['models'];
        $model = new $model;

        $model = $model::query()->findorfail($item);

        $references= array();
        foreach ($model->getReferenceTable() as $table){
            $chameleon = new Chameleon($table);
            $references[$table] = $chameleon::query()->get();
        }
        $model->references = $references;
        $references_many= array();
        foreach ($model->getTableRelationMany() as $table){
            $chameleon = new Chameleon($table);
            $references_many[$table] = $chameleon::query()->get();
        }
        $model->references_many = $references_many;
        $model->relation();
        $model->relationMany();
        $data = [
            'action' => 'update',
            'model' => $model,
            'route'=>$name,
        ];

        return view('admin.crud.form',$data);
//        return view(self::info['folder'] . '.form', $data);
    }


    public function edit(Request $request, $item)
    {
        $model = self::info['models'];

        $model = $model::findorfail($item);

        $validator = $model::$info['validate'];
        $request->validate($validator);

        $model::_save($request->all(), $model);

        return redirect()->back();
    }

    public function delete($item){
        $model = self::info['models'];

        $model = $model::findorfail($item);
        foreach ($model->images as $image){
            $model->imageDeleteToPublic($image->name);
            $image->delete();
        }
        $model->delete();
        return redirect()->back();
    }


}
