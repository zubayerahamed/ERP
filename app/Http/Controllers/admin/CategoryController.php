<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends KitController
{
    public function index()
    {
        return view('admin.category', [
            'categories' => Category::with('parentCategory')->get(),
            'category' => new Category()
        ]);
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $slug = $request->get('slug');
        if ($slug == '') $slug = strtolower(str_replace(" ", "-", trim($request->get('name'))));

        $rf = $request->all();
        $rf['slug'] = $slug;
        if ($request->get('active') != null) {
            $rf['active'] = true;
        } else {
            $rf['active'] = false;
        }

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
            'categories' => Category::with('parentCategory')->get(),
            'category' => $category,
        ]);
    }

    public function update(Category $category, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $category->name = $rf['name'];
        $category->seqn = $rf['seqn'];
        if ($rf['parent_category_id'] != null || $rf['parent_category_id'] != '') $category->parent_category_id = $rf['parent_category_id'];
        if ($request->get('active') != null) {
            $category->active = true;
        } else {
            $category->active = false;
        }
        $updated = $category->update();
        if ($updated) {
            return redirect()->route('category.edit', $category->slug)->with('success', "Category " . $category->name . " Updated successfully");
        }
        return back()->with('error', "Can't update category " . $category->name);
    }

    public function delete($slug)
    {
        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $deleted = $category->delete();

        if ($deleted) {
            return redirect()->route('category.page')->with('success', "Category " . $category->name . " deleted successfully");
        }
        return back()->with('error', "Can't delete category " . $category->name);
    }

    public function updateImage(Category $category, Request $request)
    {
        $folderPath = public_path('upload/category/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;


        if (!is_dir($folderPath)) {
            mkdir($folderPath);
        }

        file_put_contents($imageFullPath, $image_base64);

        $previousAvatar = $category->image;
        $category->image = $imageName;
        $category->update();

        // Delete previous avatar
        $prevImagePath = public_path() . $previousAvatar;
        if ($previousAvatar != '/assets/admin-assets/img/category-default.png') {
            unlink($prevImagePath);
        }

        return response()->json(['success' => 'Image updated sucessfully']);
    }
}
