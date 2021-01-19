<?php

namespace HR\Http\Controllers;

use HR\JobDepartment;
use Illuminate\Http\Request;

class JobDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments =JobDepartment::orderBy('id','asc')
            ->paginate(25);
        return view('admin.departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'string|max:80|unique:tags'
        ]);
        JobDepartment::create([
            'name' => $request['name'],
            'parent_id' => ($request['parent_id']=='')? null : $request['parent_id']
        ]);
        return redirect()->route('departments.index')
            ->with('flash_message',
                'حوزه کاری با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = JobDepartment::FindOrFail($id);

        return view('admin.departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'string|max:80|unique:tags'
        ]);

        $departments = JobDepartment::FindOrFail($id);
        $departments->name = $request['name'];
        $departments->parent_id = ($request['parent_id']=='')? null : $request['parent_id'];
        $departments->save();

        return redirect()->route('departments.index')
            ->with('flash_message',
                'حوزه کاری  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JobDepartment::destroy($id);

        return redirect()->route('departments.index')
            ->with('flash_message',
                'حوزه کاری  با موفقیت حذف گردید');
    }

    public function restore($id){
        $dep = JobDepartment::onlyTrashed()->findOrFail($id);
        $dep->restore();
        return redirect()->route('departments.index')
            ->with('flash_message',
                'حوزه کاری با موفقیت بازیابی شد');
    }

    public function Search()
    {
        if(request('status') == 'all')
            $departments=JobDepartment::withTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        elseif (request('status') == '0')
            $departments=JobDepartment::onlyTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        else
            $departments=JobDepartment::orderBy('id','asc');

        if(request('name')!='')
            $departments->where('name','like','%'.request('name').'%');
        $departments = $departments->paginate(25);
        return view('admin.departments.index',compact('departments'));
    }
}
