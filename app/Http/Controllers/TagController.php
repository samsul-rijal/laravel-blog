<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tag = Tags::paginate(10);
        return view('admin.tag.index', compact('tag'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:20|min:3'
        ]);

        Tags::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success','Tag berhasil disimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = Tags::findorfail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $tag_data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        Tags::whereId($id)->update($tag_data);

        return redirect()->route('tag.index')->with('success','Tag berhasil di update');
    }

    public function destroy($id)
    {
        //
    }
}
