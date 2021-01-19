<?php

namespace HR\Http\Controllers;

use HR\Company;
use HR\WorkerList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WorkerListController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = WorkerList::where('id','>=',1);
        $companies = Company::all();

        # national_code contains ...
        if (request('national_code') != '') {
            $national_code = request('national_code');
            $workers->where('national_code','like', '%' . $national_code . '%');
        }

        # company  ...
        if (request('company_id') != '') {
            $company_id = request('company_id');
            $workers->where('company_id', $company_id);
        }

        $workers = $workers->get()->sortByDesc('id')->take(120);

        $worker_national_code = $workers->pluck('national_code')->toArray();

        $users = DB::table('users')
            ->select('user_profiles.national_code','users.first_name', 'users.last_name')
            ->leftjoin('user_profiles','user_profiles.user_id', '=', 'users.id')
            ->whereIn('national_code', $worker_national_code)->get();
        $user_lists = array();

        foreach ($users as $user)
            $user_lists[$user->national_code]=['first_name' => $user->first_name, 'last_name'=> $user->last_name];


        $workers = $workers->split(3);

        return view('admin.workers.index',compact(['workers','companies', 'user_lists']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
            $companies = Company::all()->pluck('name','id')->toArray();
        else
            $companies = auth()->user()->company->pluck('name','id')->toArray();


        return view('admin.workers.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #validate
        $this->validate($request,[
            'national_code' => 'required|string|max:10|min:10|unique:worker_lists,national_code',
            'company_id' => 'required|exists:companies,id'
        ]);

        #create From fillable inputs
        WorkerList::create($request->all());


        if(isset($request['saveAndClose']) && $request['saveAndClose'] == 'ذخیره و بستن')
            return redirect()->route('worker-list.index')
                ->with('flash_message',
                    'آیتم  با موفقیت ایجاد گردید');

        if(isset($request['save']) && $request['save'] == 'ذخیره')
            return redirect()->back()
                ->with('flash_message',
                    'آیتم  با موفقیت ایجاد گردید');

        if(isset($request['saveAndNew']) && $request['saveAndNew'] == 'ذخیره و جدید')
            return redirect()->route('worker-list.create')
                ->with('flash_message',
                    'آیتم  با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  \HR\WorkerList  $workerList
     * @return \Illuminate\Http\Response
     */
    public function show(WorkerList $workerList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HR\WorkerList  $workerList
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkerList $workerList)
    {
        if(
            (!auth()->user()->hasRole('برنامه نویس') && !auth()->user()->hasRole('سوپرادمین'))
            &&
            (!in_array($workerList->company_id, auth()->user()->company->pluck('id')->toArray()))
        )
            return redirect()->route('worker-list.index')
                ->withErrors(['شما دسترسی ویرایش این کاربر را ندارید']);
        if(auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
            $companies = Company::all()->pluck('name','id')->toArray();
        else
            $companies = auth()->user()->company->pluck('name','id')->toArray();

        return view('admin.workers.edit', compact(['companies', 'workerList']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HR\WorkerList  $workerList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkerList $workerList)
    {
        #validate
        $this->validate($request,[
            'national_code' => 'required|string|max:10|min:10|unique:worker_lists,national_code,'.$workerList->id,
            'company_id' => 'required|exists:companies,id'
        ]);

        $workerList->update($request->all());

        return redirect()->route('worker-list.index')
            ->with('flash_message','آیتم با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HR\WorkerList  $workerList
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkerList $workerList)
    {
        if(
            (!auth()->user()->hasRole('برنامه نویس') && !auth()->user()->hasRole('سوپرادمین'))
            &&
            (!in_array($workerList->company_id, auth()->user()->company->pluck('id')->toArray()))
        )
            return redirect()->route('worker-list.index')
                ->withErrors(['شما دسترسی حذف این کاربر را ندارید']);

        if($workerList->delete())
            return redirect()->route('worker-list.index')
                ->with('flash_message','ایتم با موفقیت حذف شد');

        return redirect()->route('worker-list.index')
            ->with('flash_message','خطا در حذف آیتم');

    }
}
