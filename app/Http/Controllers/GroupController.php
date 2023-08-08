<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GroupController extends Controller
{

    public function __construct()
    {
        Cache::put('page', 'group');
        $this->groups = Group::all();

        $this->data = [
            'groups' => $this->groups,
        ];
    }

    public function index()
    {
        return view('group.index')->with($this->data);
    }

    // Showing the view for create
    public function create()
    {
        $data = ['operation' => 'create'];
        return view('group.crud')->with($data);
    }

    // Creating the group record
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $group = Group::create([
            'name' => $request->name
        ]);

        return redirect('/group')->with('success', ('Group created successfully'));
    }

    // Showing the view for edit
    public function edit($id)
    {
        $group = Group::query()->findOrFail($id);
        $data = [
            'operation' => 'edit',
            'group' => $group,
        ];

        return view('group.crud')->with($data);
    }

    // Updating the group record
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $group = Group::query()->findOrFail($id);
        $group->name = $request->name;

        try {
            $group->save();
            return redirect('group')->with('success', ('Group updated successfully'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    // Deleting the group record
    public function destroy($id)
    {
        try {
            Group::destroy($id);
            return redirect('group')->with('success',  ('Group deleted successfully'));
        } catch (Exception $e) {
            return redirect('group')->with('error',  ("Group couldn't be deleted") . $e->getMessage());
        }
    }

    // Show the view (form) for adding/removing users to/from group
    public function users($id)
    {
        $group = Group::query()->findOrFail($id); // group users data is already there with 'users' relation
        $potential_users = User::query()->doesntHave('groups')->get();

        $this->data = [
            'group' => $group,
            'potential_users' => $potential_users,
        ];

        return view('group.users')->with($this->data);
    }


    public function attach_users(Request $request, $id)
    {
        // get given group
        $group = Group::query()->findOrFail($id);

        // get potential users id
        $users_ids = $request->input('potential_users');

        try {
            // Add users to groups
            $group->users()->attach($users_ids);
            return back()->with('success', 'Users added to group successfully');


        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function detach_users(Request $request, $id)
    {
        // get given group
        $group = Group::query()->findOrFail($id);

        // get users that will be deleted
        $users_ids = $request->input('current_users');

        try {
            // Remove users from groups
            $group->users()->detach($users_ids);
            return back()->with('success', 'Users removed from group successfully');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

}
