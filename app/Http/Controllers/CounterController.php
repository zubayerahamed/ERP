<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Shop;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index(Shop $shop)
    {
        return view('admin.counter', [
            'counters' => Counter::where('shop_id', '=', $shop->id)->get(),
            'counter' => new Counter(),
            'shop' => $shop
        ]);
    }

    public function edit(Counter $counter)
    {
        return view('admin.counter', [
            'counters' => Counter::where('shop_id', '=', $counter->shop_id)->get(),
            'counter' => $counter,
            'shop' => $counter->shop
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

        $counter = Counter::create($rf);
        if ($counter) {
            return redirect()->route('counter.page', $counter->shop_id)->with('success', 'Counter Created Successfully');
        }

        return back()->with('error', "Can't create counter");
    }

    public function update(Counter $counter, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $counter->name = $rf['name'];
        $counter->seqn = $rf['seqn'];
        if ($request->get('active') != null) {
            $counter->active = true;
        } else {
            $counter->active = false;
        }
        $updated = $counter->update();
        if ($updated) {
            return redirect()->route('counter.edit', $counter->slug)->with('success', "Counter " . $counter->name . " updated successfully");
        }
        return back()->with('error', "Can't update counter " . $counter->name);
    }
}
