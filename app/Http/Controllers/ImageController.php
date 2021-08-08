<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    //
    public function flyResize($size, $imagePath)
    {
        if (preg_match('/^https:*/', $imagePath) === 1) {
            $img = Image::make(resizeImage($imagePath, $size));
            header('Content-Type: image/png');
            return $img->response();
        }
        $imageFullPath = public_path($imagePath);
        $size = explode("x", $size);
        // $sizes = $size;

        // if (!file_exists($imageFullPath) || !isset($sizes[$size])) {
        //     abort(404);
        // }

        // $savedPath = public_path('resizes/' . $size . '/' . $imagePath);
        // $savedDir = dirname($savedPath);
        // if (!is_dir($savedDir)) {
        //     mkdir($savedDir, 777, true);
        // }

        // list($width, $height) = $sizes[$size];


        $image = Image::make($imageFullPath)->fit($size[0], $size[1]);

        return $image->response();
    }
}
