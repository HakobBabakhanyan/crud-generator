<?php

if (!function_exists('get_validate_error')){
    function get_validate_error($error){
        return preg_replace('/([a-z0-9])\.([a-z0-9])/','$1 $2',$error);
    }
}

if(!function_exists('deleteElementArray')){
    function deleteElementArray($element, $array){
        $index = array_search($element, $array);
        if($index !== false){
            unset($array[$index]);
        }
        return $array;
    }
}

if (!function_exists('setLanguage')) {
    function setLanguage($languages, $language)
    {
        if ($languages->where('slug', Request::segment(1))->isNotEmpty()) {
            $url = Request::segments();
            $url[0] = $language->slug;
            $url = implode('/', $url);
            return $url;
        } else {
            $url = Request::segments();
            array_unshift($url, $language->slug);
            $url = implode('/', $url);
            return $url;
        }
    }
}
