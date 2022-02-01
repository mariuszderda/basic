<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public function AllCat()
    {
        $categories = Category::latest()->paginate(5);
        $trashCategories = Category::onlyTrashed()->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCategories'));
    }

    public function AddCat(Request $request)
    {
        $validated_data = $request->validate([
            'category_name' => 'required|unique:categories|string|max:12',
        ],
            [
                'category_name.required' => 'Please Input Category Name',
            ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
//        $data = array();
//        $data['category_name'] = $request->category_name;
//        $data['user_id'] = Auth::user()->id;
//        DB::table('categories')->insert($data);


        return redirect()->back()->with('success', 'Category add successfully');
    }

    public function UpdateCat(Request $request, $id)
    {
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('all.category')->with('success', 'Category updated successfully');
    }

    public function EditCat($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function RemoveCat(Category $id, Request $request)
    {
        $id->delete();
        return redirect()->back()->with('success', 'Category removed successfully');
    }

    public function restoreCat($id)
    {
        $restore = Category::onlyTrashed()->find($id)->restore();

        return redirect()->route('all.category')->with('success', 'Category restored successfully');
    }

    public function PDelete($id)
    {
        $pDelete = Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('all.category')->with('success', 'Category permanently deleted successfully');
    }
}
