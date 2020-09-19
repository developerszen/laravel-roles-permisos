<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasAnyRole(['editor', 'writer'])) {
            abort(403);
        }

        $users = User::with('roles')->latest()->paginate(8);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User);

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('password'),
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit', $user);

        $user->update([
            'enabled' => $request->has('enabled') ? true : false,
        ]);

        if(auth()->user()->hasRole('super-admin')) {
            if($request->has('all_edit')) {
                $permissions = ['posts.edit.*'];

                $this->createEditPermissions($permissions);

                $user->syncPermissions($permissions);
            }
        }

        return redirect()->route('users.index');
    }

    private function createEditPermissions($permissions) {
        collect($permissions)->each(function($permission) {
            $exists = Permission::where('name', $permission)->exists();

            if(!$exists) {
                Permission::create([
                    'name' => $permission,
                ]);
            }
        });
    }

}
