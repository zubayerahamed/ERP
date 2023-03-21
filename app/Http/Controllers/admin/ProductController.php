<?php

namespace App\Http\Controllers\admin;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\Term;
use Illuminate\Http\Request;

class ProductController extends KitController
{
    public function index()
    {
        return view('admin.products', [
            'products' => Product::with('categories','thumbnail')->get()
        ]);
    }

    public function addNewPage()
    {

        return view('admin.product-create', [
            'categories' => Category::with('childCategories')->whereNull('parent_category_id')->get(),
            'product' => new Product(),
            'medias' => Media::all(),
            'attributes' => Attribute::with('terms')->get()
        ]);
    }

    public function edit(Product $product)
    {

        // $a = $product->categories->all();
        // dd($product->categories->all());

        return view('admin.product-create', [
            'categories' => Category::with('childCategories')->whereNull('parent_category_id')->get(),
            'product' => $product,
            'medias' => Media::all(),
            'attributes' => Attribute::with('terms')->get()
        ]);
    }

    public function save(Request $request)
    {

        //dd($request->all());

        $product = Product::create($request->all());

        $categories = Category::whereIn('id', $request['categories'])->get();

        $product->categories()->attach($categories);

        $saved = $product->save();

        if($request['attributes']){
            foreach($request['attributes'] as $attributesId){
                $attr = Attribute::where('id','=',$attributesId)->first();
                $product->attrs()->attach($attr);
            }
        }

        if($request['terms']){
            foreach($request['terms'] as $termId){
                $term = Term::where('id','=',$termId)->first();
                $product->terms()->attach($term);
            }
        }

        if ($saved) {
            return redirect()->route('product.edit', $product->id)->with('success', 'Product created successfully');
        }
        return back()->with('error', 'Product not created');
    }

    public function update(Product $product, Request $request)
    {

        //dd($request->all());

        $product->categories()->detach();

        $categories = Category::whereIn('id', $request['categories'])->get();
        $product->categories()->attach($categories);

        $product->attrs()->detach();
        if($request['attributes']){
            foreach($request['attributes'] as $attributesId){
                $attr = Attribute::where('id','=',$attributesId)->first();
                $product->attrs()->attach($attr);
            }
        }
        
        $product->terms()->detach();
        if($request['terms']){
            foreach($request['terms'] as $termId){
                $term = Term::where('id','=',$termId)->first();
                $product->terms()->attach($term);
            }
        }

        $updated = $product->update($request->all());

        if ($updated) {
            return redirect()->route('product.edit', $product->id)->with('success', 'Product updated successfully');
        }
        return back()->with('error', 'Product not update');
    }
}
