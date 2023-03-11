<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends KitController
{
    public function index()
    {

        $categories = Category::all();

        return view('admin.category', [
            'categories' => $categories,
            'category' => new Category()
        ]);
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $slug = $request->get('slug');
        if ($slug == '') $slug = strtolower(str_replace(" ", "-", trim($request->get('name'))));

        $rf = $request->all();
        $rf['slug'] = $slug;

        $category = Category::create($rf);
        if ($category) {
            return redirect()->route('category.page')->with('success', 'Category Created Successfully');
        }

        return back()->with('error', "Can't create category");
    }

    public function edit($slug)
    {
        $category = Category::where('slug', '=', $slug)->firstOrFail();
        return view('admin.category', [
            'categories' => Category::all(),
            'category' => $category,
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $rf = $request->all();
        $category->name = $rf['name'];
        $category->parent_category_id = $rf['parent_category_id'];
        $updated = $category->update();
        if ($updated) {
            return redirect()->route('category.edit', $category->slug)->with('success', "Category " . $category->name . " Updated successfully");
        }
        return back()->with('error', "Can't update category " . $category->name);
    }
}
