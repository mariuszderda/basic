<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function SliderAll()
    {
        $sliders = Slider::inRandomOrder()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function SliderAdd()

    {
        return view('admin.slider.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'image' => ['required']
        ]);

        $slider_image = $request->file('image');

        $last_img = $this->save_image($slider_image);

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('slider.all')->with('success', 'New slider created');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $old_image = $request->old_image;

        $image = $request->file('image');

        if ($image) {
            $last_img = $this->save_image($image);
            unlink($old_image);

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->route('slider.all')->with('success', 'Slider edit successfully.');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        unlink($slider->image);
        $slider->delete();

        return redirect()->back()->with('success', 'Slider delete successfully.');
    }


    private function save_image($image): string
    {
        $name_gen = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('image/slider/' . $name_gen);

        return 'image/slider/' . $name_gen;
    }
}
