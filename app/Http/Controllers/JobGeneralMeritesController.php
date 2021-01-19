<?php

namespace HR\Http\Controllers;

use HR\JobGeneralMerites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobGeneralMeritesController extends Controller
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
        $generalMerites =JobGeneralMerites::orderBy('id','asc')
            ->paginate(10);
        $ptrs = JobGeneralMerites::all()->pluck('name','id')->toArray();
        
        return view('admin.generalMerites.index',compact(['generalMerites', 'ptrs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('سوپرادمین')){
        return view('admin.generalMerites.create');
        }else{
            abort('403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->hasRole('سوپرادمین'))){
            abort('403');
        }

        $this->validate($request,[
            'name' => 'string|max:80|unique:job_general_merites'
        ]);
        JobGeneralMerites::create([
            'name' => $request['name'],
        ]);
        return redirect()->route('generalMerites.index')
            ->with('flash_message',
                'شایستگی عمومی با موفقیت ایجاد گردید');
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
        $generalMerite = JobGeneralMerites::FindOrFail($id);

        return view('admin.generalMerites.edit',compact('generalMerite'));
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
            'name' => 'string|max:80|unique:job_general_merites'
        ]);

        $generalMerites = JobGeneralMerites::FindOrFail($id);
        $generalMerites->name = $request['name'];
        $generalMerites->save();

        return redirect()->route('generalMerites.index')
            ->with('flash_message',
                'شایستگی عمومی  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JobGeneralMerites::destroy($id);

        return redirect()->route('generalMerites.index')
            ->with('flash_message',
                'شایستگی عمومی  با موفقیت حذف گردید');
    }

    public function restore($id){
        $dep = JobGeneralMerites::onlyTrashed()->findOrFail($id);
        $dep->restore();
        return redirect()->route('generalMerites.index')
            ->with('flash_message',
                'شایستگی عمومی با موفقیت بازیابی شد');
    }

    public function Search()
    {
        if(request('status') == 'all')
            $generalMerites=JobGeneralMerites::withTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        elseif (request('status') == '0')
            $generalMerites=JobGeneralMerites::onlyTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        else
            $generalMerites=JobGeneralMerites::orderBy('id','asc');

        if(request('name')!='')
            $generalMerites->where('name','like','%'.request('name').'%');
        $generalMerites = $generalMerites->paginate(10);
        
        $ptrs = JobGeneralMerites::all()->pluck('name','id')->toArray();
    
        return view('admin.generalMerites.index',compact(['generalMerites', 'ptrs']));
    }
    
    public function replace($id)
    {
        $this->validate(\request(),[
            'with' => 'required'
        ]);
        $main = JobGeneralMerites::find($id);
        $with = JobGeneralMerites::find(request('with'));
        
        if(!is_null($main) && !is_null($with)) {
            DB::table('job_has_general_merites')
                ->where('general_merites_id', $main->id)
                ->update(['general_merites_id' => $with->id]);
        }
        return redirect()->back()->with('flash_message','جایگزینی با موفقیت انجام شد');
    }
    
    
    public function export(){
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=csvExp_' . \p3ym4n\JDate\JDate::now()->toDateString() . '.csv;');
        header('Content-Transfer-Encoding: binary');
        $data = array();
        $title_array = array();
        $generalMerites = JobGeneralMerites::all();
        
        foreach ($generalMerites as $item) {
            $data_array = array();
            ########################################################################
            $title_array[] = 'کد';
            
            $data_array[]= $item->id;
            ########################################################################
            $title_array[] = 'عنوان';
            
            $data_array[]= $item->name;
            ########################################################################
            
            
            if (!isset($data[0]))
                $data[0] = implode('~', $title_array);

//            dd($tmp);
            
            $data[] = implode('~',$data_array);
        }
//        dd($data);
        $fp = fopen('php://output', 'w');
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        foreach ($data as $line) {
            $val = explode("~", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }
}
