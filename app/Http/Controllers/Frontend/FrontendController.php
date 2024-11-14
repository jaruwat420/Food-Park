<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;


class FrontendController extends Controller
{
    //
    function index() {

        $sliders = Slider::where('status', 1)->get();
        return view('frontend.home.index',compact('sliders'));
    }


}
