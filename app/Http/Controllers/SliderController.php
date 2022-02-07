<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function SliderAll()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function SliderAdd()

    {
        return view('admin.slider.create');
    }
}
