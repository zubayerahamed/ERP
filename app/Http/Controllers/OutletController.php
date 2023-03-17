<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index(Business $business)
    {
        return view('admin.outlet', [
            'outlets' => Outlet::with('shops')->where('business_id', '=', $business->id)->get(),
            'outlet' => new Outlet(),
            'business' => $business
        ]);
    }

    public function edit(Outlet $outlet)
    {
        return view('admin.outlet', [
            'outlets' => Outlet::with('shops')->where('business_id', '=', $outlet->business_id)->get(),
            'outlet' => $outlet,
            'business' => $outlet->business
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

        $outlet = Outlet::create($rf);
        if ($outlet) {
            return redirect()->route('outlet.page', $outlet->business_id)->with('success', 'Outlet Created Successfully');
        }

        return back()->with('error', "Can't create outlet");
    }

    public function update(Outlet $outlet, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $outlet->name = $rf['name'];
        $outlet->seqn = $rf['seqn'];
        if ($request->get('active') != null) {
            $outlet->active = true;
        } else {
            $outlet->active = false;
        }
        $updated = $outlet->update();
        if ($updated) {
            return redirect()->route('outlet.edit', $outlet->slug)->with('success', "Outlet " . $outlet->name . " updated successfully");
        }
        return back()->with('error', "Can't update outlet " . $outlet->name);
    }
}
