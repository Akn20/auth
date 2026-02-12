<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;  
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;  

class BloodGroupController extends Controller
{

    public function index()
    {
        $bloodGroups = BloodGroup::orderBy('blood_group_name')->paginate(10);
        return view('masters.blood-groups.index', compact('bloodGroups'));
    }


    public function create()
    {
        return view('masters.blood-groups.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'blood_group_name' => [
                'required',
                Rule::unique('blood_group_master', 'blood_group_name')->whereNull('deleted_at'),
            ],

            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        BloodGroup::create([
            'blood_group_name' => strtoupper($request->blood_group_name),
            'status' => $request->status,
            'created_by' => auth()->id() ?? 1,
        ]);

        return redirect()->route('blood-groups.index')->with('success', 'Blood group added.');
    }
    
    public function edit(string $id)
    {
        $bloodGroup = BloodGroup::findOrFail($id);
        return view('masters.blood-groups.edit', compact('bloodGroup'));
    }

    
    public function update(Request $request, string $id)
    {
        $bloodGroup = BloodGroup::findOrFail($id);

        $request->validate([
            'blood_group_name' => [
                'required',
            ],

            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $bloodGroup->update([
            'blood_group_name' => strtoupper($request->blood_group_name),
            'status' => $request->status,
            'updated_by' => auth()->id() ?? 1,
        ]);

        return redirect()->route('blood-groups.index')->with('success', 'Blood group updated.');

    }

    
    public function destroy(string $id)
    {
        $bloodGroup = BloodGroup::findOrFail($id);
        $bloodGroup->delete();

        return back()->with('success', 'Blood group deleted.');
    }

    public function deletedHistory()
    {
        $bloodGroups = BloodGroup::onlyTrashed()
            ->orderBy('blood_group_name')
            ->paginate(10);

        return view('masters.blood-groups.deleted', compact('bloodGroups'));
    }

    public function restore(string $id)
    {
        $bloodGroup = BloodGroup::onlyTrashed()->findOrFail($id);
        $bloodGroup->restore();

        return redirect()->route('blood-groups.deleted')->with('success', 'Blood group restored successfully.');
    }

    public function forceDelete(string $id)
    {
        $bloodGroup = BloodGroup::onlyTrashed()->findOrFail($id);
        $bloodGroup->forceDelete();

        return redirect()->route('blood-groups.deleted')->with('success', 'Blood group permanently deleted.');
    }
}
