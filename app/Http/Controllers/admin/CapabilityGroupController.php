<?php

namespace App\Http\Controllers\admin;

use App\Models\CapabilityGroup;
use Illuminate\Http\Request;

class CapabilityGroupController extends KitController
{
    public function index()
    {
        return view('admin.capability-group', [
            'cg' => new CapabilityGroup(),
            'cges' => CapabilityGroup::with('capabilities')->get()
        ]);
    }

    public function edit(CapabilityGroup $capabilityGroup)
    {
        return view('admin.capability-group', [
            'cg' => $capabilityGroup,
            'cges' => CapabilityGroup::with('capabilities')->get()
        ]);
    }

    public function save(Request $request)
    {

        $rf = $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $cg = CapabilityGroup::create($rf);
        if ($cg) {
            return redirect()->route('cg.page')->with('success', 'Group creaed successfully');
        }

        return back()->with('error', 'Group not created');
    }

    public function update(CapabilityGroup $capabilityGroup, Request $request)
    {

        $rf = $request->validate([
            'name' => 'required',
            'seqn' => 'required'
        ]);

        $capabilityGroup->name = $rf['name'];
        $capabilityGroup->seqn = $rf['seqn'];

        $updated = $capabilityGroup->update();
        if ($updated) {
            return redirect()->route('cg.edit', $capabilityGroup->id)->with('success', 'Group updated successfully');
        }

        return back()->with('error', 'Group not updated');
    }
}
