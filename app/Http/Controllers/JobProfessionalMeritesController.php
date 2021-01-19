<?php

namespace HR\Http\Controllers;

use HR\JobProfessionalMerites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobProfessionalMeritesController extends Controller
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
    public function batchdelete(Request $request)
    {
        /**
         * M.Mahdavi Kia
         */
        $batch_array = explode(',',$request['batchDelete']);
        foreach($batch_array as $key => $value)
            if(empty($value))
                unset($batch_array[$key]);

        JobProfessionalMerites::destroy($batch_array);

        return redirect()->route('professionalMerites.index')
            ->with('flash_message',
                'عملیات با موفقیت انجام شد');
    }
    public function index()
    {

        $jobs_professional_merites = array_unique(DB::table('job_has_professional_merites')
            ->pluck('professional_merites_id')->toArray());

        $professionalMerites = JobProfessionalMerites::whereIn('id',$jobs_professional_merites)
            ->orderBy('id','asc')
            ->paginate(10);
        
        $ptrs = JobProfessionalMerites::whereIn('id',$jobs_professional_merites)->pluck('name','id')->toArray();

        return view('admin.professionalMerites.index',compact(['professionalMerites', 'ptrs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professionalMerites.create');
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
            'name' => 'string|max:80|unique:job_professional_merites'
        ]);
        JobProfessionalMerites::create([
            'name' => $request['name'],
        ]);
        return redirect()->route('professionalMerites.index')
            ->with('flash_message',
                'شایستگی تخصصی با موفقیت ایجاد گردید');
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
        $professionalMerite = JobProfessionalMerites::FindOrFail($id);

        return view('admin.professionalMerites.edit',compact('professionalMerite'));
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
            'name' => 'string|max:80|unique:job_professional_merites,name,'.$id
        ]);

        $professionalMerites = JobProfessionalMerites::FindOrFail($id);
        
        $professionalMerites->name = $request['name'];
        $professionalMerites->save();

        return redirect()->route('professionalMerites.index')
            ->with('flash_message',
                'شایستگی تخصصی  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JobProfessionalMerites::destroy($id);

        return redirect()->route('professionalMerites.index')
            ->with('flash_message',
                'شایستگی تخصصی  با موفقیت حذف گردید');
    }

    public function restore($id){
        $dep = JobProfessionalMerites::onlyTrashed()->findOrFail($id);
        $dep->restore();
        return redirect()->route('professionalMerites.index')
            ->with('flash_message',
                'شایستگی تخصصی با موفقیت بازیابی شد');
    }

    public function Search()
    {
        $users_professional_merites = array_merge(
            array_merge(
                DB::table('resume_has_exp_expertises')->pluck('professional_merites_id')->toArray(),
                DB::table('resume_has_p_t_r')->pluck('professional_merites_id')->toArray()),
            DB::table('resume_has_com_skills')->pluck('professional_merites_id')->toArray())
        ;
        $users_professional_merites = array_unique($users_professional_merites);
        $jobs_professional_merites = array_unique(DB::table('job_has_professional_merites')
            ->pluck('professional_merites_id')->toArray());
        $blocked_professional_merites = array_diff($users_professional_merites,$jobs_professional_merites);
        
        if(request('status') == 'all')
            $professionalMerites=JobProfessionalMerites::withTrashed()->where('id','>','0')
                ->whereNotIn('id',$blocked_professional_merites)->orderBy('id','asc');

        elseif (request('status') == '0')
            $professionalMerites=JobProfessionalMerites::onlyTrashed()->where('id','>','0')
                ->whereNotIn('id',$blocked_professional_merites)->orderBy('id','asc');

        else
            $professionalMerites=JobProfessionalMerites::orderBy('id','asc')->whereNotIn('id',$blocked_professional_merites);

        if(request('name')!='')
            $professionalMerites->where('name','like','%'.request('name').'%')
                ->whereNotIn('id',$blocked_professional_merites);
        $professionalMerites = $professionalMerites->paginate(10);
    
        $ptrs = JobProfessionalMerites::whereNotIn('id',$blocked_professional_merites)->pluck('name','id')->toArray();
    
        return view('admin.professionalMerites.index',compact(['professionalMerites','jobs_professional_merites','ptrs']));
    }
    
    public function replace($id)
    {
        
        $this->validate(\request(),[
            'with' => 'required'
        ]);
        $main = JobProfessionalMerites::find($id);
        $with = JobProfessionalMerites::find(request('with'));
        
        if(!is_null($main) && !is_null($with)) {
            DB::table('resume_has_exp_expertises')
                ->where('professional_merites_id', $main->id)
                ->update(['professional_merites_id' => $with->id]);
            
            DB::table('resume_has_p_t_r')
                ->where('professional_merites_id', $main->id)
                ->update(['professional_merites_id' => $with->id]);
            
            DB::table('resume_has_com_skills')
                ->where('professional_merites_id', $main->id)
                ->update(['professional_merites_id' => $with->id]);
            
            DB::table('job_has_professional_merites')
                ->where('professional_merites_id', $main->id)
                ->update(['professional_merites_id' => $with->id]);
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
        $users_professional_merites = array_merge(
            array_merge(
                DB::table('resume_has_exp_expertises')->pluck('professional_merites_id')->toArray(),
                DB::table('resume_has_p_t_r')->pluck('professional_merites_id')->toArray()),
            DB::table('resume_has_com_skills')->pluck('professional_merites_id')->toArray())
        ;
        $users_professional_merites = array_unique($users_professional_merites);
        $jobs_professional_merites = array_unique(DB::table('job_has_professional_merites')
            ->pluck('professional_merites_id')->toArray());
        $blocked_professional_merites = array_diff($users_professional_merites,$jobs_professional_merites);
        $professionalMerites =JobProfessionalMerites::whereNotIn('id',$blocked_professional_merites)->get();
        
        foreach ($professionalMerites as $item) {
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
