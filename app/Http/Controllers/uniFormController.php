<?php

namespace HR\Http\Controllers;
use HR\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class uniFormController extends Controller
{

    public function create()
    {
        $industries = Industry::all();

        return view('site.pages.myDesk',compact('industries'));

    }

    public function store(Request $request)
    {
//        $this->validate($request, [
//            'first_name' => 'required|string|max:30|min:2',
//            'last_name' => 'required|string|max:30|min:2',
//            'student_id' => 'required|integer|max:1000000000',
//            'mobile' => 'required|string|max:15',
//            'email' => 'required|email',
//            'interests' => 'required|array',
//            'interests.*' => 'string|exists:industries,name',
//            'cv' => 'file|mimes:pdf|max:5000',
//            'uni_captcha' =>'check_captcha:uni_captcha|required|string|max:10',
//            'wantRegister' => 'nullable|string'
//        ]);
//        //dd($_POST);
//        $cv=null;
//        if($request['cv'])
//        {
//            $cv=$request['mobile'].'-'.$request['student_id'].'.pdf';
//            Storage::disk('resume')->putFileAs('UniResume',$request['cv'] ,$cv);
//        }
//        DB::table('uni')->insert(
//            [
//                'first_name' =>  $request['first_name'],
//                'last_name' =>  $request['last_name'],
//                'student_id' =>  $request['student_id'],
//                'mobile' =>  $request['mobile'],
//                'email' =>  $request['email'],
//                'interests' =>  implode(', ',$request['interests']),
//                'cv' =>  $cv,
//                'wantRegister' => isset($request['wantRegister'])?1:0
//            ]
//        );

        $this->validate($request, [
            'first_name' => 'required|string|max:30|min:2',
            'last_name' => 'required|string|max:30|min:2',
            'mobile' => 'required|string|max:15',
            'text' => 'required|string|max:5000',
            'uni_captcha' =>'check_captcha:uni_captcha|required|string|max:10',
        ]);

        DB::table('festival')->insert(
            [
                'first_name' =>  $request['first_name'],
                'last_name' =>  $request['last_name'],
                'mobile' =>  $request['mobile'],
                'text' =>  $request['text']
            ]
        );

        return redirect()->back() ->with('flash_message',
            'اطلاعات شما در سیستم ثبت شد.');

    }
}