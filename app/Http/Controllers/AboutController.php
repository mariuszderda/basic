<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\composerRequire;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    public function create()
    {
        return view ('admin.about.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => ['required', 'string'],
            'short_description' => ['required', 'string'],
            'long_description' => ['required', 'string'],
        ]);

        About::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('about.list')->with('success', 'About successfully created');
    }

    public function edit($id)
    {
        $about = About::find($id);

        return view ('admin.about.edit', compact('about'));
    }

    public function update (Request $request, $id)
    {
        About::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('about.list')->with('success', 'About successfully updated.');
    }

    public function delete($id)
    {
        About::find($id)->delete();
        return redirect()->route('about.list')->with('success', 'About successfully deleted.');

    }
}
