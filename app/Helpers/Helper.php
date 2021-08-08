<?php

use Illuminate\Support\Str;

if (!function_exists('resizeImage')) {
    function resizeImage($uri, $size)
    {
        // https://image.thanhnien.vn/400x300/uploaded/vankhoa/2021_07_12/vcisrael_aznv.jpg
        return str_replace('400x300', $size, $uri);
    }
}


if (!function_exists('fullSizeImage')) {
    function fullSizeImage($uri)
    {
        // https://image.thanhnien.vn/400x300/uploaded/vankhoa/2021_07_12/vcisrael_aznv.jpg
        return str_replace('400x300/', '', $uri);
    }
}



if (!function_exists('createCacheKey')) {
    function createCacheKey($a, $b = '', $c = '')
    {
        return md5(vsprintf('%s.%s.%s', [
            $a,
            $b,
            $c,
        ]));
    }
}
