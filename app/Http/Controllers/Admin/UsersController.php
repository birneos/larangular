<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// First, we tell Laravel that we want to use the User model
use App\User;

use App\Http\Requests\UserEditFormRequest;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    

    public function index(){
 
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }


    /* The results of Eloquent queries are always returned as Collection instances. */
    // https://laravel.com/docs/5.5/collections
    // -> pluck
    public function edit($id){

        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selectedRoles = $user->roles()->pluck('name')->toArray();

        var_dump($selectedRoles );
        return view('backend.users.edit', compact('user', 'roles', 'selectedRoles'));
        
       
    }

    public function update($id, UserEditFormRequest $request)
    {
        $user = User::whereId($id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if($password != "") {
            $user->password = Hash::make($password);
        }
        $user->save();
    
        // syncRoles is a laravel-permission method that we can use to automatically sync (attach and detach) multiple roles.
        $user->syncRoles($request->get('role'));
    
        return redirect(action('Admin\UsersController@edit', $user->id))->with('status', 'The user has been updated!');
    }

}
