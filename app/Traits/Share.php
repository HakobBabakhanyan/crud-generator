<?php

namespace App\Traits;

use App\Models\Languages;
use Illuminate\Support\Facades\Cache;

trait Share
{
    private $shared = [];

    public function admin_share()
    {
        if (count($this->shared)) return false;

        $languages = Cache::rememberForever('languages',function (){
           return Languages::query()->where('status', 1)->get();
        });



        $this->shared = [
            'user' => auth()->user(),
            'languages' => $languages
        ];
        view()->share($this->shared);

        return true;
    }
}
