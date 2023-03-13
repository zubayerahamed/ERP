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
        return view('admin.products');
    }

    public function addNewPage()
    {

        return view('admin.product-create', [
            'categories' => Category::whereNull('parent_category_id')->get()
        ]);
    }

    public function save(Request $request){
//        dd($request->all());


        // $product = new Product();
        // $product->name = $request['name'];
        // $product->desc = $request['desc'];
        // $product->short_desc = $request['short_desc'];

        $request['user_id'] = Auth::guard('admin')->user()->id;
        $product = Product::create($request->all());

        $categories = Category::whereIn('id', $request['categories'])->get();
        //dd($categories->all());

        $product->categories()->attach($categories);

        $saved = $product->save();
        if($saved){
            return redirect()->route('product.add-new')->with('success', 'Product created successfully');
        }
        return redirect()->route('product.add-new')->with('error', 'Product not created');
    }
}
