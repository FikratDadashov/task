<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ModuleController extends Controller
{

    public function __construct()
    {
        Cache::put('page', 'module');
        $this->modules = Module::all();

        $this->data = [
            'modules' => $this->modules,
        ];
    }

    public function index()
    {
        return view('module.index')->with($this->data);
    }

    // Showing the view for create
    public function create()
    {
        $data = ['operation' => 'create'];
        return view('module.crud')->with($data);
    }

    // Creating the module record
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $module = Module::create([
            'name' => $request->name
        ]);

        return redirect('/module')->with('success', ('Module created successfully'));
    }

    // Showing the view for edit
    public function edit($id)
    {
        $module = Module::query()->findOrFail($id);
        $data = [
            'operation' => 'edit',
            'module' => $module,
        ];

        return view('module.crud')->with($data);
    }

    // Updating the module record
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $module = Module::query()->findOrFail($id);
        $module->name = $request->name;

        try {
            $module->save();
            return redirect('module')->with('success', ('Module updated successfully'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Deleting the module record
    public function destroy($id)
    {
        try {
            Module::destroy($id);
            return redirect('module')->with('success',  ('Module deleted successfully'));
        } catch (Exception $e) {
            return redirect('module')->with('error',  ("Module couldn't be deleted") . $e->getMessage());
        }
    }

}
