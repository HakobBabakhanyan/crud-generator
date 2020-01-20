<?php

namespace App\Http\Middleware;

use App\Traits\CustomizeUrl;
use Closure;
use Illuminate\Support\Facades\Cookie;

class Languages
{
    use CustomizeUrl;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->checkSlug($request->segment(1))) {
            if ($this->setLanguage($request->segment(1))) {
                return $next($request);
            };
        } elseif(Cookie::has('language')) {
            //  if( Cookie::get('language') == $this->getStaticLangSlug() && $this->setLanguage($this->getLanguage()) ) return $next($request);
            $this->setLanguage($this->getLanguage());
            $url = $request->segments();
            array_unshift($url, Cookie::get('language'));
            $url = implode('/', $url);
            session()->reflash();
            if($request->isMethod('post')) return $next($request);

            return redirect()->to($url);

        }else{

            $this->setLanguage($this->getLanguage());

            return $next($request);

        };

        dump('Perebor ))) language middleware');

        return $next($request);
    }
}
