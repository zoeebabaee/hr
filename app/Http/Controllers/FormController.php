<?php

namespace HR\Http\Controllers;

use HR\Form;
use HR\myFuncs;
use HR\SMS;
use HR\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.forms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        # Convert to en
        foreach ($request->all() as $key=>$value)
            $request[$key] = myFuncs::nums_to_en($request[$key]);

        # Validation
        $this->validate($request, [
            'captcha'       =>  'check_captcha:form|required|string|max:10',
            'name'          =>  'required|string|max:255',
            'request_type'  =>  'required|array|max:5',
            'email'         =>  'required|email',
            'mobile'        =>  'required|regex:/[0-9]{11}/u|unique:forms,mobile',
            'description'   =>  'required|max:2500',
            'resume'        =>  'required|file|max:10240|mimetypes:image/png,image/jpeg,application/pdf'
        ]);

        # Create Form Entity
        $form = new Form();
        $form->name = $request['name'];
        $form->request_type = json_encode($request['request_type']);
        $form->email = $request['email'];
        $form->mobile = $request['mobile'];
        $form->description = $request['description'];
        $form->save();

        # Save File
        Storage::disk('form')->makeDirectory($request['mobile']);
        Storage::disk('form')->put($request['mobile'].'/', $request->file('resume'));

        $user_exist = false;
        $sms_text = '';

        $user_exist = User::where('mobile', $request['mobile'])->count();

        $user_exist?
            $sms_text = $request['name']." عزیز، سلام"
            ."\n"."با سپاس از حضورتان در نمایشگاه IT دانشگاه شریف،از شما دعوت میگردد جهت بررسی موقعیتهای شغلی جدید به سامانه منابع انسانی گروه صنعتی گلرنگ،به آدرس www.people.Golrang.com مراجعه فرمائید."
        :
            $sms_text = $request['name']." عزیز، سلام"
                ."\n"."با سپاس از حضورتان در نمایشگاه IT دانشگاه شریف،از شما دعوت میگردد جهت عضویت و تکمیل رزومه خود در سامانه منابع انسانی گروه صنعتی گلرنگ،به آدرس www.people.Golrang.com مراجعه فرمائید.";

        $sms = new SMS();
        $sms->Send($sms_text, $request['mobile'],0,'sharif_fair',1);

        return redirect()->back()->with('flash_message', 'مشخصات شما با موفقیت ثبت گردید.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
