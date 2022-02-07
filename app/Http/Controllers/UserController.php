<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

//        $user = User::all();
      $user =  auth()->user()->latest()->paginate(10);

        return view('admin.users.index', compact('user'));
    }
    public function show(User $user){

//        $this->authorize('view', Auth::user(), ['user']);

        return view('admin.users.profile', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update($id, Request $request){

        $input = $request->validate([
            'username' => ['required', 'string', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'avatar' => ['file:jpeg.png'],
        ]);

        if ($request->avatar){

            $input['avatar'] = $request->avatar->store('images');
        }
        auth()->user()->update(array_merge($input));

        return back();
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }

    public function delete($id, Request  $request){

        $user = User::findOrFail($id);
        $user->delete();

        $request->session()->flash('user-delete', 'User has been deleted');

        return back();

    }
}
