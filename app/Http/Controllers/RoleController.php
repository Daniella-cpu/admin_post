<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){

        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }
    public function edit(Role $role){
        return view('admin.roles.edit',
            ['role' => $role,
                'permissions' =>Permission::all()]);
    }

    public function store(){
        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::lower(request('name'))
        ]);
        session()->flash('role-created', 'role has been created');
        return back();
    }

    public function update(Role $role, Request $request){

        $role->name = Str::ucfirst($request->name);
        $role->slug = Str::of($request->name)->slug('-');


        if ($role->isDirty('name')){

            session()->flash('role-updated', 'Role has been updated');
            $role->save();
        }else{
            session()->flash('role-updated', 'Role has not been updated');
        }
        return back();
    }

    public function attachPermit(Role $role){
        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detachPermit(Role $role){
        $role->permissions()->detach(request('permission'));

        return back();
    }

    public function delete($id){
        $roles = Role::findOrFail($id);

        $roles->delete();

        return back();

    }
}
