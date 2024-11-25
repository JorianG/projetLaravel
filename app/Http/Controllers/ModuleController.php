<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::paginate(10);
        return view('module.index', compact('modules'));
    }

    public function create()
    {
        return view('module.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:module|max:255',
            'name' => 'required|max:255',
        ]);

        Module::create($request->all());
        return redirect()->route('module.index')->with('success', 'Module created successfully.');
    }

    public function show(Module $module)
    {
        return view('module.show', compact('module'));
    }

    public function edit(Module $module)
    {
        return view('module.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'code' => 'required|max:255|unique:module,code,' . $module->id,
            'name' => 'required|max:255',
        ]);

        $module->update($request->all());
        return redirect()->route('module.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('module.index')->with('success', 'Module deleted successfully.');
    }
}
