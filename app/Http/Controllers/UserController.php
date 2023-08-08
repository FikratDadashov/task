<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{

    public function __construct()
    {
        Cache::put('page', 'user');
        $this->users = User::all();

        $this->data = [
            'users' => $this->users,
        ];
    }

    public function index()
    {
        return view('user.index')->with($this->data);
    }

    // Showing the view for create
    public function create()
    {
        $data = ['operation' => 'create'];
        return view('user.crud')->with($data);
    }

    // Creating the user record
    public function store(Request $request)
    {

        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:user'],
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username
        ]);

        return redirect('/user')->with('success', ('User created successfully'));

    }

    // Showing the view for edit
    public function edit($id)
    {
        $user = User::query()->findOrFail($id);
        $data = [
            'operation' => 'edit',
            'user' => $user,
        ];

        return view('user.crud')->with($data);
    }

    // Updating the user record
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:user,username, ' . $id]
        ]);

        $user = User::query()->findOrFail($id);
        $user->fullname = $request->fullname;
        $user->username = $request->username;

        try {
            $user->save();
            return redirect('user')->with('success', ('User updated successfully'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Deleting the user record
    public function destroy($id)
    {
        try {
            User::destroy($id);
            return redirect('user')->with('success',  ('User deleted successfully'));
        } catch (Exception $e) {
            return redirect('user')->with('error',  ("User couldn't be deleted") . $e->getMessage());
        }
    }

}
