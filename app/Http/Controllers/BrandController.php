<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request): RedirectResponse
    {
        $validated_data = $request->validate([
            'brand_name' => ['required', 'min:3', 'unique:brands'],
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ],
            [
                'brand_name.required' => 'Please Input Brand Name.',
                'brand_name.unique' => 'This brand name is already exist.'
            ]);

        $brand_image = $request->file('brand_image');

//        $name_gen = hexdec(uniqid('', true));
//        $image_ext = strtolower($brand_image->getClientOriginalExtension());
//        $img_name = $name_gen.'.'.$image_ext;
//        $up_location = 'image/brand/';
//        $last_img = $up_location.$img_name;
//        $brand_image->move($up_location,$img_name);

        $name_gen = hexdec(uniqid('', true)) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300)->save('image/brand/' . $name_gen);

        $last_img = 'image/brand/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'New brand created');

    }

    public function RemoveBrand($id): RedirectResponse
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
        Brand::find($id)->delete();
        return redirect()->route('all.brand')->with('success', 'Brand remove success');
    }

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function UpdateBrand(Request $request, $id)
    {
        $validated_data = $request->validate([
            'brand_name' => ['required', 'min:3'],
        ],
            [
                'brand_name.required' => 'Please Input Brand Name.',
            ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid('', true));
            $image_ext = strtolower($brand_image->getClientOriginalExtension());

            $img_name = $name_gen . '.' . $image_ext;

            $up_location = 'image/brand/';

            $last_img = $up_location . $img_name;

            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Brand updated created');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Brand updated created');
        }
    }

    public function Multipic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request)
    {
        $validated_data = $request->validate([
            'image' => ['required'],
        ],
            [
                'image.required' => 'Please add some image.'
            ]
        );
        $images = $request->file('image');

        foreach ($images as $image) {
            $name_gen = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('image/multi/' . $name_gen);

            $last_img = 'image/multi/' . $name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Image successfully inserted');

    }
}
