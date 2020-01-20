<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait  ResourceController
{

    private static $configs;
    public function __construct(){
        self::$configs = config('custom-config.crud.'.$this->config_name);
        $this->middleware(function ($request,$next){
            $this->admin_share();
            view()->share(['custom_configs'=>self::$configs]);
            return $next($request);
        });
    }
    /***
     * @param bool $name
     * the delete
     * @return bool|\Illuminate\Config\Repository|mixed
     */
    private function params($name = false)
    {
        if (config('custom-config.crud.' . $this->config_name)) {
            if ($name) {
                return config('custom-config.crud.' . $this->config_name . '.' . $name);
            } else
                return config('custom-config.crud.' . $this->config_name);
        }
        return false;
    }

    public function index()
    {
        $model = new self::$configs['model'];
        $items = $model->query();
        if(isset(self::$configs['sortable']) && self::$configs['sortable']){
            $items = $model->orderBy(self::$configs['sortable']);
        }
        $data = [
            'items' => $items->get(),
            'params' => self::$configs,
        ];

        return view('admin.crud.index', $data);
    }


    public function create()
    {

        $data = [
            'action' => 'store',
            'params' => self::$configs,
            'item'=>new self::$configs['model']
        ];

        return view('admin.crud.form', $data);
    }


    public function store(Request $request)
    {
        $request->validate(self::$configs['validate']['store']);
        $model = new self::$configs['model'];

        $model->_save($request->all(), self::$configs);

        return redirect()->route('admin.' . self::$configs['route'] . '.index');
    }


    public function edit($item)
    {
        $model = new self::$configs['model'];
        $item = $model->query()->findOrFail($item);

        $data = [
            'action' => 'update',
            'item' => $item,
            'params' => self::$configs,
        ];

        return view('admin.crud.form', $data);
    }


    public function update(Request $request, $item)
    {
        $request->validate(self::$configs['validate']['update']);

        $model = new self::$configs['model'];
        $item = $model->query()->findOrFail($item);

        $model->_save($request->all(), self::$configs, $item);

        return redirect()->route('admin.' . self::$configs['route'] . '.index');
    }


    public function destroy($item)
    {
        $model = new self::$configs['model'];

        $item = $model->query()->findOrFail($item);
        $delete = true;
        if(isset(self::$configs['custom_column']) && self::$configs['custom_column']){
            foreach (self::$configs['custom_column'] as $key=>$v){
                if(isset($v['$item->$key'])){
                    $delete = false;
                    break;
                }
            }
        };
        if($delete){
            if(isset(self::$configs['images']) && self::$configs['images']){
                $model->imagesDestroy($item->id);
            }
            $item->delete();
        }
        return redirect()->back();
    }

    public function imageDestroy($item){
        $model = new self::$configs['model'];

       return  $model->imageDestroy($item);
    }

    public function fileDestroy($item){
        $model = new self::$configs['model'];

        return  $model->fileDestroy($item);
    }
    public function sortable(Request $request){
        $model = new self::$configs['model'];

        return $model->sortable($request['data']);
    }

}
