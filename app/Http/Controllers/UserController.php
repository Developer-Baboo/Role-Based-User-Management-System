<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Role
};
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(3); // Paginate with 3 users per page
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        // return view('users.create', ['users' => $roles]);
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>  'required|email|unique:users,email',
            // 'password' =>'required|string|min:5',
            'roles' => 'required|array'
        ]);

        $user = User::create($request ->all());
        $user->roles()->attach($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' =>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Fix the unique rule
            'password' => 'nullable |string|min:5',
            'roles' => 'required|array'
        ]);


        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]); // Update the user's information

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        $user->roles()->sync($request->input('roles')); // Sync user roles
        return redirect()->route('users.index')->with('success', 'User Updated successfully');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->roles()->detach(); // Detach roles
        $user->delete(); // Delete the user
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
