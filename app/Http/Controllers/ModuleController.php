<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::latest()->get();
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        $modules = Module::all(); // for parent module dropdown
        return view('modules.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_label' => 'required',
            'module_display_name' => 'required',
            'priority' => 'required|numeric',
            'icon' => 'required',
            'file_url' => 'required',
            'page_name' => 'required',
            'type' => 'required',
            'access_for' => 'required',
        ]);

        Module::create($request->all());

        return redirect()->route('modules.index')
                         ->with('success', 'Module Created Successfully');
    }
}
