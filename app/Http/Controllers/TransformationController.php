<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransformationController extends Controller
{

    public function transformation(){
        return view('image_transform/index_transform');
    }

    public function generativeBackground(){
        return view('image_transform/generative_background');
    }
    public function generativeFill(){
        return view('image_transform/generative_fill');
    }
    public function generativeReplace(){
        return view('image_transform/generative_replace');
    }
    public function generativeRecolor(){
        return view('image_transform/generative_recolor');
    }
    public function generativeRemove(){
        return view('image_transform/generative_remove');
    }
    public function generativeRestore(){
        return view('image_transform/generative_restore');
    }
    public function generativeEnhance(){
        return view('image_transform/generative_enhance');
    }

    public function generativeUpscale(){
        return view('image_transform/generative_upscale');
    }

    public function media(){

        return view('image_transform/media_gallery');
    }


}
