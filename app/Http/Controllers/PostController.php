<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts', [
            'posts' => Post::with('categories','thumbnail')->get()
        ]);
    }

    public function add()
    {
        return view('admin.post-create', [
            'categories' => Category::with('childCategories')->whereNull('parent_category_id')->get(),
            'post' => new Post(),
            'medias' => Media::all()
        ]);
    }

    public function edit(Post $post)
    {

        return view('admin.post-create', [
            'categories' => Category::with('childCategories')->whereNull('parent_category_id')->get(),
            'post' => $post,
            'medias' => Media::all(),
            'attributes' => Attribute::with('terms')->get()
        ]);
    }

    public function save(Request $request)
    {

        $post = Post::create($request->all());

        $categories = Category::whereIn('id', $request['categories'])->get();

        $post->categories()->attach($categories);

        $saved = $post->save();

        if($request['attributes']){
            foreach($request['attributes'] as $attributesId){
                $attr = Attribute::where('id','=',$attributesId)->first();
                $post->attrs()->attach($attr);
            }
        }

        if ($saved) {
            return redirect()->route('post.edit', $post->id)->with('success', 'Post created successfully');
        }
        return back()->with('error', 'Post not created');
    }

    public function update(Post $post, Request $request)
    {

        //dd($request->all());

        $post->categories()->detach();

        $categories = Category::whereIn('id', $request['categories'])->get();
        $post->categories()->attach($categories);

        $updated = $post->update($request->all());

        if ($updated) {
            return redirect()->route('post.edit', $post->id)->with('success', 'Post updated successfully');
        }
        return back()->with('error', 'Post not update');
    }
}
