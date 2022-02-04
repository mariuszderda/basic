<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
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

        $name_gen = hexdec(uniqid('', true));
        $image_ext = strtolower($brand_image->getClientOriginalExtension());

        $img_name = $name_gen.'.'.$image_ext;

        $up_location = 'image/brand/';

        $last_img = $up_location.$img_name;

        $brand_image->move($up_location,$img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'New brand created');

    }

    public function RemoveBrand($id): RedirectResponse
    {
        $brand = Brand::find($id)->delete();

        return redirect()->route('all.brand')->with('succes', 'Brand remove success');
    }

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }
}
