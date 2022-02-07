<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){

        return view('admin.permissions.index',
            ['permissions' => Permission::all()]);
    }

    public function store(Request $request){
        request()->validate([
            'name' => ['required']
        ]);

        Permission::create([
            'name' => Str::ucfirst($request->name),
            'slug' => Str::lower($request->name)
        ]);
        session()->flash('permission-created', 'permission has been created');
        return back();
    }

    public function edit(Permission $permission){

        return view('admin.permissions.edit',
            ['permission' => $permission]);
    }

    public function update(Permission $permission, Request $request){
        $permission->name = Str::ucfirst($request->name);
        $permission->slug = Str::of($request->name)->slug('-');


        if ($permission->isDirty('name')){

            session()->flash('permission-updated', 'permission has been updated');
            $permission->save();
        }else{
            session()->flash('permission-updated', 'permission has not been updated');
        }
        return back();
    }

    public function delete(Permission $permission){

        $permission->delete();
        return back();
    }
}
