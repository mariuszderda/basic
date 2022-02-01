<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
        $validated_data = $request->validate([
            'brand_name' => ['required', 'max:255', 'unique:brands']
        ]);

        $brand = Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => 'test',
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'New brand created');

    }

    public function RemoveBrand($id)
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
