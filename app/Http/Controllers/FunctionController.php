<?php

namespace App\Http\Controllers;

use App\Models\Functions;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FunctionController extends Controller
{

    public function __construct()
    {
        Cache::put('page', 'function');
        $this->functions = Functions::all();
        $this->modules = Module::all();

        $this->data = [
            'functions' => $this->functions,
            'modules' => $this->modules,
        ];
    }

    public function index()
    {
        return view('function.index')->with($this->data);
    }

    // Showing the view for create
    public function create()
    {
        $this->data += ['operation' => 'create'];
        return view('function.crud')->with($this->data);
    }

    // Creating the function record
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $function = Functions::create([
            'name' => $request->name,
            'module_id' => $request->module_id
        ]);

        return redirect('/function')->with('success', ('Function created successfully'));
    }

    // Showing the view for edit
    public function edit($id)
    {
        $function = Functions::query()->findOrFail($id);
        $this->data += [
            'operation' => 'edit',
            'function' => $function,
        ];

        return view('function.crud')->with($this->data);
    }

    // Updating the function record
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $function = Functions::query()->findOrFail($id);
        $function->name = $request->name;
        $function->module_id = $request->module_id;

        try {
            $function->save();
            return redirect('function')->with('success', ('Function updated successfully'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Deleting the function record
    public function destroy($id)
    {
        try {
            Functions::destroy($id);
            return redirect('function')->with('success',  ('Function deleted successfully'));
        } catch (Exception $e) {
            return redirect('function')->with('error',  ("Function couldn't be deleted") . $e->getMessage());
        }
    }

}
