<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\KitController;
use App\Models\Attribute;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends KitController
{
    public function index(Attribute $attribute)
    {
        return view('admin.term', [
            'terms' => Term::where('attribute_id','=',$attribute->id)->get(),
            'term' => new Term(),
            'attribute' => $attribute
        ]);
    }

    public function edit($slug)
    {
        $term = Term::with('attribute')->where('slug', '=', $slug)->firstOrFail();

        return view('admin.term', [
            'terms' => Term::where('attribute_id','=',$term->attribute_id)->get(),
            'term' => $term,
            'attribute' => $term->attribute
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $slug = $request->get('slug');
        if ($slug == '') {
            $slug = strtolower(str_replace(" ", "-", trim($request->get('name'))));
        } else {
            $slug = strtolower(str_replace(" ", "-", trim($request->get('slug'))));
        }

        $rf = $request->all();
        $rf['slug'] = $slug;
        if ($request->get('active') != null) {
            $rf['active'] = true;
        } else {
            $rf['active'] = false;
        }

        $term = Term::create($rf);
        if ($term) {
            return redirect()->route('term.page', $term->attribute_id)->with('success', 'Term Created Successfully');
        }

        return back()->with('error', "Can't create term");
    }

    public function update(Term $term, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $term->name = $rf['name'];
        $term->seqn = $rf['seqn'];
        if ($request->get('active') != null) {
            $term->active = true;
        } else {
            $term->active = false;
        }
        $updated = $term->update();
        if ($updated) {
            return redirect()->route('term.edit', $term->slug)->with('success', "Term " . $term->name . " updated successfully");
        }
        return back()->with('error', "Can't update term " . $term->name);
    }
}
