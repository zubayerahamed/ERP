<?php

namespace App\Http\Controllers\admin;

use App\Models\Capability;
use App\Models\CapabilityGroup;
use Illuminate\Http\Request;

class CapabilityController extends KitController
{
    public function index(CapabilityGroup $capabilityGroup)
    {

        return view('admin.capability', [
            'capabilityGroup' => $capabilityGroup,
            'capability' => new Capability(),
            'capabilities' => Capability::where('capability_group_id', '=', $capabilityGroup->id)->get()
        ]);
    }

    public function edit(Capability $capability)
    {

        return view('admin.capability', [
            'capabilityGroup' => $capability->capabilityGroup,
            'capability' => $capability,
            'capabilities' => Capability::where('capability_group_id', '=', $capability->capability_group_id)->get()
        ]);
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $slug = strtolower(str_replace(" ", "-", trim($request->get('name'))));

        $rf = $request->all();
        $rf['slug'] = $slug;

        $cap = Capability::create($rf);
        if ($cap) {
            return redirect()->route('capability.page', $cap->capability_group_id)->with('success', 'Capability Created Successfully');
        }

        return back()->with('error', "Can't create Capability");
    }

    public function update(Capability $capability, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $rf = $request->all();
        $capability->name = $rf['name'];
        $capability->seqn = $rf['seqn'];

        $updated = $capability->update();
        if ($updated) {
            return redirect()->route('capability.edit', $capability->slug)->with('success', "Capability " . $capability->name . " updated successfully");
        }
        return back()->with('error', "Can't update capability " . $capability->name);
    }
}
