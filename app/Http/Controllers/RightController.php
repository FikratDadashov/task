<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Group;
use App\Models\User;
use App\Models\Functions;
use App\Models\UserFunction;
use Illuminate\Http\Request;

class RightController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->modules = Module::all();
        $this->groups = Group::all();
        $this->users = User::all();
        $this->functions = Functions::all();


        $this->data = [
            'modules' => $this->modules,
            'groups' => $this->groups,
            'users' => $this->users,
            'functions' => $this->functions,
        ];
    }

    public function index()
    {
        return view('right.index')->with($this->data);
    }

    public function edit()
    {
        return view('right.crud')->with($this->data);
    }

    // Update the user rights
    public function update(Request $request)
    {
        $module_id = $request->module_id;
        $group_id = $request->group_id;
        $user_id = $request->user_id;
        $function_id = $request->function_id;

        $functions = Functions::query()->select('id')->where('module_id', $module_id)->get();
        $users = Group::query()->find($group_id)->users;
        if ($user_id)
            $users = User::query()->whereIn('id',$user_id)->get();
        if ($function_id)
            $functions = Functions::query()->select('id')->whereIn('id',$function_id)->get();

        foreach ($users as $user) {
            foreach ($functions as $function){
                UserFunction::query()->UpdateOrInsert(['user_id'=>$user->id, 'function_id'=>$function->id]);
            }
        }

        return redirect('right')->with('success',  ('Rights added successfully'));
    }

    // filter the data with selected options
    public function fetch_rights(Request $request)
    {
        $module_id = $request->get('module_id');
        $group_id = $request->get('group_id');
        $user_id = $request->get('user_id');
        $function_id = $request->get('function_id');

        $functions = Functions::query()->where('module_id', $module_id)->get();
        $users = Group::query()->find($group_id)->users;
        $array = ['users'=>$users, 'functions'=>$functions];
        echo json_encode($array);
    }

    // Deleting the user right record
    public function delete_right(Request $request)
    {
        $function_id = $request->get('function_id');
        $user_id = $request->get('user_id');

        UserFunction::where(['function_id'=>$function_id, 'user_id'=>$user_id])->delete();
    }

}
