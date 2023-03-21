<?php

namespace App\Http\Controllers\admin;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends KitController
{
    public function index()
    {
        return view('admin.business', [
            'business' => new Business(),
            'businesses' => Business::with('outlets')->get()
        ]);
    }

    public function edit(Business $business)
    {
        return view('admin.business', [
            'business' => $business,
            'businesses' => Business::with('outlets')->get()
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
        $rf['admin_id'] = auth('admin')->id();

        $business = Business::create($rf);
        if ($business) {
            return redirect()->route('business.page')->with('success', 'Business Created Successfully');
        }

        return back()->with('error', "Can't create business");
    }

    public function update(Business $business, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $business->name = $rf['name'];
        $business->seqn = $rf['seqn'];

        if ($request->get('active') != null) {
            $business->active = true;
        } else {
            $business->active = false;
        }

        $updated = $business->update();

        if ($updated) {
            return redirect()->route('business.edit', $business->slug)->with('success', "Business " . $business->name . " updated successfully");
        }
        return back()->with('error', "Can't update business " . $business->name);
    }
}
