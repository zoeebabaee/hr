<?php

namespace HR\Http\Controllers;

use HR\JobOrganizationalCategory;
use Illuminate\Http\Request;

class JobOrganizationalCategoryController extends Controller
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
        $organizationalCategories =JobOrganizationalCategory::orderBy('id','asc')
            ->paginate(25);
        return view('admin.organizationalCategories.index',compact('organizationalCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.organizationalCategories.create');
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
            'name' => 'string|max:80|unique:job_organizational_categories'
        ]);
        JobOrganizationalCategory::create([
            'name' => $request['name'],
        ]);
        return redirect()->route('organizationalCategories.index')
            ->with('flash_message',
                'رده سازمانی با موفقیت ایجاد گردید');
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
        $organizationalCategory = JobOrganizationalCategory::FindOrFail($id);

        return view('admin.organizationalCategories.edit',compact('organizationalCategory'));
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
            'name' => 'string|max:80|unique:job_organizational_categories'
        ]);

        $organizationalCategories = JobOrganizationalCategory::FindOrFail($id);
        $organizationalCategories->name = $request['name'];
        $organizationalCategories->save();

        return redirect()->route('organizationalCategories.index')
            ->with('flash_message',
                'رده سازمانی  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JobOrganizationalCategory::destroy($id);

        return redirect()->route('organizationalCategories.index')
            ->with('flash_message',
                'رده سازمانی  با موفقیت حذف گردید');
    }

    public function restore($id){
        $dep = JobOrganizationalCategory::onlyTrashed()->findOrFail($id);
        $dep->restore();
        return redirect()->route('organizationalCategories.index')
            ->with('flash_message',
                'رده سازمانی با موفقیت بازیابی شد');
    }

    public function Search()
    {
        if(request('status') == 'all')
            $organizationalCategories=JobOrganizationalCategory::withTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        elseif (request('status') == '0')
            $organizationalCategories=JobOrganizationalCategory::onlyTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        else
            $organizationalCategories=JobOrganizationalCategory::orderBy('id','asc');

        if(request('name')!='')
            $organizationalCategories->where('name','like','%'.request('name').'%');
        $organizationalCategories = $organizationalCategories->paginate(25);
        return view('admin.organizationalCategories.index',compact('organizationalCategories'));
    }
}
