<?php

namespace HR\Http\Controllers;

use HR\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndustryController extends Controller
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
        $industries =Industry::orderBy('id','asc')
            ->paginate(25);
        return view('admin.industries.index',compact('industries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.industries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Industry::max('industry_order') + 1;
        $this->validate($request,[
            'name' => 'string|max:30|unique:industries'
        ]);
        
        $date = date('Y-m-d H:m:i');
        $data=array('name' => $request['name'],'industry_order'=>$order,'created_at'=>$date,'updated_at'=>$date);
        DB::table('industries')->insert($data);
        return redirect()->route('industries.index')
            ->with('flash_message',
                'صنعت با موفقیت ایجاد گردید');
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
        $industry = Industry::FindOrFail($id);

        return view('admin.industries.edit',compact('industry'));
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
            'name' => 'string|max:30|unique:industries'
        ]);

        $industries = Industry::FindOrFail($id);
        $industries->name = $request['name'];
        $industries->save();

        return redirect()->route('industries.index')
            ->with('flash_message',
                'صنعت  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Industry::destroy($id);

        return redirect()->route('industries.index')
            ->with('flash_message',
                'صنعت  با موفقیت حذف گردید');
    }

    public function restore($id){
        $dep = Industry::onlyTrashed()->findOrFail($id);
        $dep->restore();
        return redirect()->route('industries.index')
            ->with('flash_message',
                'صنعت با موفقیت بازیابی شد');
    }

    public function Search()
    {
        if(request('status') == 'all')
            $industries=Industry::withTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        elseif (request('status') == '0')
            $industries=Industry::onlyTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        else
            $industries=Industry::orderBy('id','asc');

        if(request('name')!='')
            $industries->where('name','like','%'.request('name').'%');
        $industries = $industries->paginate(25);
        return view('admin.industries.index',compact('industries'));
    }
}
