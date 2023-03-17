<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Outlet $outlet)
    {
        return view('admin.shop', [
            'shops' => Shop::with('counters')->where('outlet_id', '=', $outlet->id)->get(),
            'shop' => new Outlet(),
            'outlet' => $outlet
        ]);
    }

    public function edit(Shop $shop)
    {
        return view('admin.shop', [
            'shops' => Shop::with('counters')->where('outlet_id', '=', $shop->outlet_id)->get(),
            'shop' => $shop,
            'outlet' => $shop->outlet
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

        $shop = Shop::create($rf);
        if ($shop) {
            return redirect()->route('shop.page', $shop->outlet_id)->with('success', 'Shop Created Successfully');
        }

        return back()->with('error', "Can't create shop");
    }

    public function update(Shop $shop, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $shop->name = $rf['name'];
        $shop->seqn = $rf['seqn'];
        if ($request->get('active') != null) {
            $shop->active = true;
        } else {
            $shop->active = false;
        }
        $updated = $shop->update();
        if ($updated) {
            return redirect()->route('shop.edit', $shop->slug)->with('success', "Shop " . $shop->name . " updated successfully");
        }
        return back()->with('error', "Can't update shop " . $shop->name);
    }
}
