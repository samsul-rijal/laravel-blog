<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::paginate(5);
        return view('admin.category.index', compact('category'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:5',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success','Kategori berhasil disimpan');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findorfail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5'
        ]);

        $category_data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        Category::whereId($id)->update($category_data);

        return redirect()->route('category.index')->with('success','Kategori berhasil di update');
    }

    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->delete();

        return redirect()->back()->with('success','Kategori berhasil dihapus');
    }
}
