<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends KitController
{
    public function index()
    {
        return view('admin.products', [
            'products' => Product::all()
        ]);
    }

    public function addNewPage()
    {

        return view('admin.product-create', [
            'categories' => Category::whereNull('parent_category_id')->get(),
            'product' => new Product()
        ]);
    }

    public function edit(Product $product)
    {

        // $a = $product->categories->all();
        // dd($product->categories->all());

        return view('admin.product-create', [
            'categories' => Category::whereNull('parent_category_id')->get(),
            'product' => $product
        ]);
    }

    public function save(Request $request)
    {
        $product = Product::create($request->all());

        $categories = Category::whereIn('id', $request['categories'])->get();

        $product->categories()->attach($categories);

        $saved = $product->save();
        if ($saved) {
            return redirect()->route('product.edit', $product->id)->with('success', 'Product created successfully');
        }
        return back()->with('error', 'Product not created');
    }

    public function update(Product $product, Request $request)
    {

        $product->categories()->detach();

        $categories = Category::whereIn('id', $request['categories'])->get();
        $product->categories()->attach($categories);

        $updated = $product->update($request->all());

        if ($updated) {
            return redirect()->route('product.edit', $product->id)->with('success', 'Product updated successfully');
        }
        return back()->with('error', 'Product not update');
    }
}
