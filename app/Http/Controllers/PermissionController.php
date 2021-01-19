<?php

namespace HR\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $permissions =
            Permission::where('id','>=','1')
                ->orderby('name')
                ->get()
                ->split(3);

        //dd($permissions);
        return view('admin.permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::where('id','>=','1')->get(); //Get all roles

        return view('admin.permissions.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }
        if(isset($request['saveAndClose']) && $request['saveAndClose'] == 'ذخیره و بستن')
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'دسترسی  با موفقیت ایجاد گردید');
        if(isset($request['save']) && $request['save'] == 'ذخیره')
            return redirect()->back()
            ->with('flash_message',
                'محتوا  با موفقیت ایجاد گردید');
        if(isset($request['saveAndNew']) && $request['saveAndNew'] == 'ذخیره و جدید')
            return redirect()->route('permissions.create')
                ->with('flash_message',
                    'دسترسی  با موفقیت ایجاد گردید');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $permission = Permission::findOrFail($id);
        if ($permission->name == "Programmer") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'نمیتوانید سطح دسترسی برنامه نویس را ویرایش کنید');
        }
        if ($permission->name == "SuperAdmin") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'نمیتوانید سطح دسترسی سوپرادمین را ویرایش کنید');
        }
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        if ($permission->name == "Programmer") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'نمیتوانید سطح دسترسی برنامه نویس را ویرایش کنید');
        }
        if ($permission->name == "SuperAdmin") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'نمیتوانید سطح دسترسی سوپرادمین را ویرایش کنید');
        }
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'دسترسی بروزرسانی شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "Programmer") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'نمیتوانید سطح دسترسی برنامه نویس را حذف کنید');
        }
        if ($permission->name == "SuperAdmin") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'نمیتوانید سطح دسترسی سوپرادمین را حذف کنید');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission deleted!');

    }
}