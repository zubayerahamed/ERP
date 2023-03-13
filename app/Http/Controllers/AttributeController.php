<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\KitController;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends KitController
{
    public function index()
    {
        return view('admin.attribute', [
            'attributes' => Attribute::all(),
            'attribute' => new Attribute()
        ]);
    }

    public function edit($slug)
    {
        return view('admin.attribute', [
            'attributes' => Attribute::all(),
            'attribute' => Attribute::where('slug', '=', $slug)->firstOrFail()
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

        $attribute = Attribute::create($rf);
        if ($attribute) {
            return redirect()->route('attribute.page')->with('success', 'Attribute Created Successfully');
        }

        return back()->with('error', "Can't create attribute");
    }

    public function update(Attribute $attribute, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $attribute->name = $rf['name'];
        $attribute->seqn = $rf['seqn'];
        if ($request->get('active') != null) {
            $attribute->active = true;
        } else {
            $attribute->active = false;
        }
        $updated = $attribute->update();
        if ($updated) {
            return redirect()->route('attribute.edit', $attribute->slug)->with('success', "Category " . $attribute->name . " updated successfully");
        }
        return back()->with('error', "Can't update attribute " . $attribute->name);
    }
}
