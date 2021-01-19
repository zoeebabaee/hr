@extends('layout.site.default.global.main')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection
@section('custom_css')
    {{ Html::style('/site/'.config('app.site_theme').'/css/dmuploader.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd !important;
            text-align: center !important;
            padding: 8px !important;
        }

        .textarea-rtl {
            text-align: right;
            direction: rtl;
            height: 200px;
        }
    </style>
@endsection
@section('title')
    سامانه منابع انسانی :: پروفایل
@endsection
@section('content')
    @include('site.pages.user.side_bar')
    {{ Form::open(array('method'=>'PUT','route' => 'user.resume.5.store','files' => true, 'class' => 'form-horizontal people-forms','onsubmit'=>'return check_salary()')) }}
    <div class="col-md-12" id="scroll-resume">
        @if (count($errors) > 0)
            <div class="bg-error" style="text-align: right">
                <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                @foreach ($errors->all() as $error)
                    <p style="direction: rtl">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="bg-success" style="text-align: right">
                <a href="" class="close-success"><i class="fa fa-remove"></i></a>
                <p style="direction: rtl">{!! session('flash_message') !!}</p>
            </div>
        @endif
        <div class="container">
            <fieldset class="red-fieldset mt-7">
                <legend> نام و مشخصات شغلی اعضای خانواده</legend>
            </fieldset>
            @php
                $c=1;
            @endphp
            @if($resume->family->count()==0)
                <div class="wrapper-family-table">
                    <table class="family-table">
                        <div class="row family-table">
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <input type="text" value="" name="Family[{{$c}}][name]"
                                           class="name form-control people-forms-fields form-control">
                                    <label>نام و نام خانوادگی</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <select data-validation="required" data-placeholder="یک گزینه انتخاب کنید"
                                            name="Family[{{$c}}][relation]"
                                            class="relation-select form-control people-forms people-forms-fields">
                                        <option value="">انتخاب کنید...</option>
                                        <option value="1">پدر</option>
                                        <option value="2">مادر</option>
                                        <option value="3">خواهر</option>
                                        <option value="4">برادر</option>
                                        <option value="5">همسر</option>
                                        <option value="6">فرزند</option>
                                    </select>
                                    <label>نسبت</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <input type="text" value="" id="job_{{$c}}" name="Family[{{$c}}][job]"
                                           class="job form-control people-forms-fields">
                                    <label>شغل</label>
                                    <input type="checkbox" id="unemployed_{{$c}}" name="Family[{{$c}}][unemployed]"
                                           class="unemployed">
                                    <label for="unemployed_{{$c}}" class="mt-2 mb-2"> عدم اشتغال</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="people-forms-fields-group">
                                    <input type="text" value="" id="organization_{{$c}}"
                                           name="Family[{{$c}}][organization]"
                                           class="organization form-control people-forms-fields">
                                    <label>سازمان/صنف</label>
                                </div>
                            </div>
                        </div>
                    </table>
                </div>
            @else
                @foreach($resume->family as $family)
                    @php
                        $c++;
                    @endphp
                    <div class="wrapper-family-table">
                        <table class="family-table">
                            <div class="row">
                                <div class="col-md-1">
									<?php if($c > 2){  ?>
                                    <button type="button" class="remove-row" title="Remove row"><img
                                                src="/site/default/Template_2019/img/remove-row-btn.svg"/></button>
									<?php } ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <input data-validation="required" type="text" value="{{$family->name}}"
                                               name="Family[{{$c}}][name]"
                                               class="name form-control people-forms people-forms-fields">
                                        <label>نام و نام خانوادگی</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <select data-validation="required" data-placeholder="یک گزینه انتخاب کنید"
                                                name="Family[{{$c}}][relation]"
                                                class="relation-select form-control people-forms people-forms-fields">
                                            <option value=""{{($family->relation==0?' selected ':'')}}>یک گزینه را
                                                انتخاب کنید
                                            </option>
                                            <option value="1"{{($family->relation==1?' selected ':'')}}>پدر</option>
                                            <option value="2"{{($family->relation==2?' selected ':'')}}>مادر</option>
                                            <option value="3"{{($family->relation==3?' selected ':'')}}>خواهر</option>
                                            <option value="4"{{($family->relation==4?' selected ':'')}}>برادر</option>
                                            <option value="5"{{($family->relation==5?' selected ':'')}}>همسر</option>
                                            <option value="6"{{($family->relation==6?' selected ':'')}}>فرزند</option>
                                        </select>
                                        <label>نسبت</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <input type="text"
                                               {{($family->job==null?' disabled ':'')}} value="{{$family->job}}"
                                               id="job_{{$c}}" name="Family[{{$c}}][job]"
                                               class="job form-control people-forms-fields">
                                        <label>شغل</label>
                                        <input type="checkbox"
                                               {{($family->job==null?' checked ':'')}}  id="unemployed_{{$c}}"
                                               onclick="unemployed({{$c}});" name="Family[{{$c}}][unemployed]"
                                               class="unemployed">
                                        <label for="unemployed_{{$c}}" class="mt-2 mb-2">عدم اشتغال</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="people-forms-fields-group">
                                        <input type="text"
                                               {{($family->job==null?' disabled ':'')}} value="{{$family->organization}}"
                                               id="organization_{{$c}}" name="Family[{{$c}}][organization]"
                                               class="organization form-control people-forms-fields">
                                        <label>سازمان/صنف</label>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>
                @endforeach
            @endif

            <div class="wrapper-family-table">
                <table class="family-table">
                    <tbody>
                    <tr>
                        <th>
                            <button type="button" class="add-row-family add-row-experimental add-row-btn"
                                    title="Add Row"><img src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span>
                            </button>
                        </th>
                    </tr>
                </table>
            </div>

            <div class="clearfix mt-5">
                <div class="col-md-12">
                    <div class="people-forms-fields-group p-0">
                        <div class="fields-required fields-required-noinput"><img
                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input border-0">
                            <div class="row mb-4 mb-md-0">
                                <div class="col-md-4">آیا سابقه محکومیت کیفری داشته اید؟</div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-4 col-md-2">
                                            <span>خیر</span>
                                            <input id="toggle-1" type="radio" data-validation="required"
                                                   onclick="crime_onchange();"
                                                   data-placeholder="یک گزینه انتخاب کنید" name="crime"
                                                   class="crime-select"
                                                   value="0" <?= ($resume->questions != null) && $resume->questions->crime != 1 ? ' checked ' : '' ?>/>
                                            <label for="toggle-1"></label>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <span>بله</span>
                                            <input id="toggle-2" type="radio" data-validation="required"
                                                   onclick="crime_onchange();"
                                                   data-placeholder="یک گزینه انتخاب کنید" name="crime"
                                                   class="crime-select"
                                                   value="1" <?= ($resume->questions != null) && $resume->questions->crime == 1 ? ' checked ' : '' ?> />
                                            <label for="toggle-2"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mahkomiat mb-3 mt-md-0 mt-5">
                        <span id="mahkomiat_span" {!! ($resume->questions != null) && $resume->questions->crime=="1"?' style="display:block" ':' style="display:none" ' !!}>
                                <div class="people-forms-fields-group col-md-12">
                                    <input data-validation="" id="crime_description"
                                           data-validation-optional-if-answered="crime" type="text"
                                           {!! ($resume->questions != null) && $resume->questions->crime!="1"?' style="display:block" ':' style="display:none" ' !!} value="{{isset($resume->questions)?$resume->questions->crime_description:''}}"
                                           name="crime_description"
                                           class="crime_description form-control people-forms-fields" placeholder="">
                                    <label>علت</label>
                                </div>
                        </span>
                </div>

                <hr class="w-100 mt-5 mt-md-0">
                <div class="col-md-12 jarahi">
                    <div class="people-forms-fields-group p-0">
                        <div class="fields-required fields-required-noinput"><img
                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input border-0">
                            <div class="row mb-4 mb-md-0">
                                <div class="col-md-4">آيا سابقه بیماری یا جراحی خاصی داشته اید؟</div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-4 col-md-2">
                                            <span>خیر</span>
                                            <input id="toggle-3" type="radio" data-validation="required"
                                                   onclick="sickness_onchange()"
                                                   data-placeholder="یک گزینه انتخاب کنید" name="sickness"
                                                   class="sabghejarahi-select"
                                                   value="0" <?= ($resume->questions != null) && $resume->questions->sickness != 1 ? ' checked ' : '' ?> />
                                            <label for="toggle-3"></label>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <span>بله</span>
                                            <input id="toggle-4" type="radio" data-validation="required"
                                                   onclick="sickness_onchange()"
                                                   data-placeholder="یک گزینه انتخاب کنید" name="sickness"
                                                   class="sabghejarahi-select"
                                                   value="1" <?= ($resume->questions != null) && $resume->questions->sickness == 1 ? ' checked ' : '' ?> />
                                            <label for="toggle-4"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mb-3  mt-md-0 mt-5">
                        <span id="sickness_description_span" {!! ((!is_null($resume->questions) && $resume->questions->sickness==0?' style="display:none" ':(is_null($resume->questions)?' style="display:none"':''))) !!}>
                                <div class="people-forms-fields-group col-md-12">
                                                <input data-validation="" type="text"
                                                       value="{{isset($resume->questions)?$resume->questions->sickness_description:''}}"
                                                       name="sickness_description" id="sickness_description"
                                                       class="namebimary form-control people-forms-fields"
                                                       placeholder="" {!! ((!is_null($resume->questions) && $resume->questions->sickness=="1")?' style="display:block" ':' style="display:none" ') !!}>
                                    <label>نام بیماری/جراحی</label>
                                </div>
                        </span>
                </div>

                <div class="col-md-12">
                    <div class="people-forms-fields-group p-0"
                         id="sickness_treatment_span" {!! ((!is_null($resume->questions) && $resume->questions->sickness==0?' style="display:none" ':(is_null($resume->questions)?' style="display:none"':''))) !!}>
                        <div class="fields-required fields-required-noinput"><img
                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input border-0">
                            <div class="row mb-4 mb-md-0">
                                <div class="col-md-4">آیا کاملا بهبود یافته اید؟</div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-4 col-md-2">
                                            <span>خیر</span>
                                            <input id="toggle-5" type="radio" data-validation="required"
                                                   data-placeholder="یک گزینه انتخاب کنید"
                                                   name="treatment" class="behbodjarahi-select"
                                                   value="0" <?= ($resume->questions != null) && $resume->questions->treatment == 0 ? ' checked ' : '' ?>/>
                                            <label for="toggle-5"></label>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <span>بله</span>
                                            <input id="toggle-6" type="radio" data-validation="required"
                                                   data-placeholder="یک گزینه انتخاب کنید"
                                                   name="treatment" class="behbodjarahi-select"
                                                   value="1" <?= ($resume->questions != null) && $resume->questions->treatment == 1 ? ' checked ' : '' ?>/>
                                            <label for="toggle-6"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="w-100 mt-5 mt-md-0">
                <div class="col-md-12 mishnasid">
                    <div class="people-forms-fields-group p-0">
                        <div class="fields-required fields-required-noinput"><img
                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input border-0">
                            <div class="row mb-4 mb-md-0">
                                <div class="col-md-4">آيا از كاركنان گروه صنعتی گلرنگ، كسي را می شناسيد؟</div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-4 col-md-2">
                                            <span>خیر</span>
                                            <input id="toggle-7" type="radio" data-validation="required"
                                                   data-placeholder="یک گزینه انتخاب کنید"
                                                   name="intro" onclick="intro_onchange()"
                                                   class="kasiramishnasid-select"
                                                   value="0" <?= ($resume->questions != null) && $resume->introducers->count() == 0 ? ' checked ' : '' ?>/>
                                            <label for="toggle-7"></label>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <span>بله</span>
                                            <input id="toggle-8" type="radio" data-validation="required"
                                                   data-placeholder="یک گزینه انتخاب کنید"
                                                   name="intro" id="intro" onclick="intro_onchange()"
                                                   class="kasiramishnasid-select"
                                                   value="1" <?= ($resume->questions != null) && $resume->introducers->count() > 0 ? ' checked ' : ''?>/>
                                            <label for="toggle-8"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="intro_span">
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button type="button" class="add-row-introducer add-row-btn" title="Add Row"><img
                                        src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span>
                            </button>
                        </div>
                    </div>
                    <div class="row tableintroducer">
                        @php
                            $d=1;
                        @endphp
                        @if($resume->introducers->count()==0)
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img
                                                src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                    <input data-validation="required" value=""
                                           type="text" name="introducer[{{$d}}][name]"
                                           id="introducer[{{$d}}][name]" class="name people-forms-fields form-control">
                                    <label>نام و نام خانوادگی</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img
                                                src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                    <input data-validation="required" value=""
                                           type="text" name="introducer[{{$d}}][company]"
                                           id="introducer[{{$d}}][company]"
                                           class="company people-forms-fields form-control">
                                    <label>نام شرکت فعلی</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img
                                                src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                    <input data-validation="required" value=""
                                           type="text" name="introducer[{{$d}}][relation]"
                                           id="introducer[{{$d}}][relation]"
                                           class="relation people-forms-fields form-control">
                                    <label>نسبت</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img
                                                src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                    <input data-validation="required" value=""
                                           type="text" name="introducer[{{$d}}][post]"
                                           id="introducer[{{$d}}][post]" class="post people-forms-fields form-control">
                                    <label>عنوان شغلی </label>
                                </div>
                            </div>
                        @else
                            @foreach($resume->introducers as $intro)
                                <div class="col-md-1">
                                    <button type="button" class="remove-row" title="Remove row"><img
                                                src="/site/default/Template_2019/img/remove-row-btn.svg"/></button>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img
                                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                        <input data-validation="required"
                                               value="{{(isset($intro->name)?$intro->name:'')}}"
                                               type="text" name="introducer[{{$d}}][name]"
                                               id="introducer[{{$d}}][name]"
                                               class="name people-forms-fields form-control">
                                        <label>نام و نام خانوادگی</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img
                                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                        <input data-validation="required"
                                               value="{{(isset($intro->company_name)?$intro->company_name:'')}}"
                                               type="text" name="introducer[{{$d}}][company]"
                                               id="introducer[{{$d}}][company]"
                                               class="company people-forms-fields form-control">
                                        <label>نام شرکت فعلی</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img
                                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                        <input data-validation="required"
                                               value="{{(isset($intro->relevance)?$intro->relevance:'')}}"
                                               type="text" name="introducer[{{$d}}][relation]"
                                               id="introducer[{{$d}}][relation]"
                                               class="relation people-forms-fields form-control">
                                        <label>نسبت</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img
                                                    src="/site/default/Template_2019/img/Group 166.svg"/></div>
                                        <input data-validation="required"
                                               value="{{(isset($intro->post)?$intro->post:'')}}"
                                               type="text" name="introducer[{{$d}}][post]"
                                               id="introducer[{{$d}}][post]"
                                               class="post people-forms-fields form-control">
                                        <label>عنوان شغلی </label>
                                    </div>
                                </div>
                                @php
                                    $d++;
                                @endphp
                            @endforeach
                        @endif
                    </div>
                </div>


                <div>
                    <div class="mt-5 position-relative">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="border-0" id="headingOne">
                            <h5 class="mb-0">
                                        <span class="text-dark font-14 pr-3 text-right d-block font-bold"
                                              data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                              aria-controls="collapseOne">
                                            مهم ترین موفقیت کاری/شخصی شما چه بوده است؟ لطفا توضیح دهید
                                        </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <textarea data-validation="required" name="q1"
                                      class="faq-txt form-control textarea-rtl">{{(isset($resume->questions)?$resume->questions->Q1:'')}}</textarea>
                        </div>
                    </div>

                    <div class="mt-5 position-relative">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="border-0" id="headingOne2">
                            <h5 class="mb-0">
                                        <span class="text-dark font-14 pr-3 text-right d-block font-bold"
                                              data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true"
                                              aria-controls="collapseOne2">
                                            اهداف کاری/ شخصی خود را برای 5 سال آینده بیان نمائید.
                                        </span>
                            </h5>
                        </div>
                        <div class="card-body">
                                    <textarea data-validation="required" name="q2"
                                              class="faq-txt form-control textarea-rtl">{{(isset($resume->questions)?$resume->questions->Q2:'')}}</textarea>
                        </div>
                    </div>
                    <div class="mt-5 position-relative">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="border-0" id="headingOne3">
                            <h5 class="mb-0">
                                        <span class="text-dark font-14 pr-3 text-right d-block font-bold"
                                              data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true"
                                              aria-controls="collapseOne3">
                                            بارزترین ارزش، توانایی یا قابلیتی که براي شرکت به همراه می آورید چیست؟
                                        </span>
                            </h5>
                        </div>
                        <div class="card-body">
                                    <textarea data-validation="required" name="q3"
                                              class="faq-txt form-control textarea-rtl">{{(isset($resume->questions->Q3)?$resume->questions->Q3:'')}}</textarea>
                        </div>
                    </div>
                    <div class="mt-5 position-relative">
                        <div class="border-0" id="headingOne4">
                            <h5 class="mb-0">
                                        <span class="text-dark font-14 pr-3 text-right d-block font-bold"
                                              data-toggle="collapse" data-target="#collapseOne4" aria-expanded="true"
                                              aria-controls="collapseOne4">
                                            درصورتی که نکته خاصی وجود دارد که احتمالا در استخدام شما موثر است، بیان نمائید.
                                        </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <textarea name="q4"
                                      class="form-control textarea-rtl faq-txt">{{(isset($resume->questions->Q4)?$resume->questions->Q4:'')}}</textarea>
                        </div>
                    </div>
                </div>


                <div class="clearfix mt-4">

                    <div class="tavfoghname font-13 text-justify mt-3">
                        اينجانب به شركت اجازه مي دهم در صورت اثبات عدم صحت مندرجات اين فرم، کتمان یا ارائه مطالب
                        خلاف واقع، هر زمان كه مختار باشد نسبت به خاتمه خدمت اينجانب اقدام یا در قرارداد تجدید نظر
                        نمايد. همچنين مطلع مي‏باشم كه استخدام اينجانب، منوط به طي يك تا سه ماه دوره آزمایشی مي‏باشد.
                        ضمنا آگاهم كه با تكميل اين پرسشنامه، شركت ملزم به استخدام اينجانب نمي‏باشد.
                    </div>

                    <div class="people-forms-fields-group font-13 text-right">
                        @if(is_null(old('accept')))
                            <input id="accid" data-validation="required" type="checkbox"
                                   @if(HR\myFuncs::is_accept(Auth::user()->complete_percent)) checked
                                   @endif {{(isset($resume->questions->treatment) && $resume->questions->treatment==1?' checked ':'')}} value="1"
                                   name="accept" class="accept">
                        @else
                            <input id="accid" data-validation="required" type="checkbox"
                                   @if(HR\myFuncs::is_accept(Auth::user()->complete_percent)) checked
                                   @endif {{(!is_null(old('accept'))?' checked ':'')}} value="1" name="accept"
                                   class="accept">
                        @endif
                        <label for="accid" class="mt-2 mb-2">مندرجات توافق نامه فوق را می پذیرم. </label>
                    </div>

                </div>

                <fieldset class="mt-5 w-100">
                    <legend class="text-left">
                        <input type="submit" class="save send-btn-green" title="ذخیره"
                               value="<?= (Auth::user()->complete_percent != 31) ? 'ذخیره و ادامه' : 'ذخیره' ?>">
                    </legend>
                </fieldset>
            </div>
        </div>
    </div>
    <!-- End scroll-resume -->
    {{Form::close()}}
    <script>
        var job = null;
        var organization = null;

        function unemployed(id) {
            var chk = $('#unemployed_' + id).is(':checked');
            if (chk) {
                job = $('#job_' + id).val();
                organization = $('#organization_' + id).val();
                $('#job_' + id).prop('disabled', true);
                $('#organization_' + id).prop('disabled', true);
                $('#job_' + id).val('');
                $('#organization_' + id).val('');
            } else {
                $('#job_' + id).val(job);
                $('#organization_' + id).val(organization);
                $('#job_' + id).prop('disabled', false);
                $('#organization_' + id).prop('disabled', false);
            }
        }

        function check_employment() {
            for (var id = 1; id < 100; id++) {
                if ($('#unemployed_' + id)) {
                    var chk = $('#unemployed_' + id).is(':checked');
                    var job = $('#job_' + id).val();
                    var organization = $('#organization_' + id).val();
                    if (!chk && job == "" && organization == "") {
                        alert('لطفا وضعیت اشتغال را مشخص فرمایید');
                        return false;
                    }
                }
            }
        }
    </script>
@endsection

@section('script')

    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}
    <script type="text/javascript">

        var Family_rowCounter = 100;
        $(document).ready(function () {
            $(".close-error").click(function () {
                $(".bg-error").hide();
                return false;
            });

        });

        var f_counter ={{$c+1}};
        $(".add-row-family").click(function () {
            f_counter++;
            Family_rowCounter++;
            var tmp = '<div class="row"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/></button></div><div class="col-md-3"><div class="people-forms-fields-group"><input data-validation="" type="text" name="Family['+ Family_rowCounter +'][name]" class="name form-control people-forms people-forms-fields "><label>نام و نام خانوادگی</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><select data-validation="required" data-placeholder="یک گزینه انتخاب کنید" name="Family['+ Family_rowCounter +'][relation]" class="relation-select people-forms people-forms-fields"><option value="">یک گزینه را انتخاب کنید</option><option value="1">پدر</option><option value="2">مادر</option><option value="3">خواهر</option><option value="4">برادر</option><option value="5">همسر</option><option value="6">فرزند</option></select><label>نسبت</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><input type="text" id="job_'+f_counter+'" name="Family['+ Family_rowCounter +'][job]" class="job form-control people-forms-fields"><label>شغل</label><input type="checkbox" id="unemployed_'+f_counter+'" onclick="unemployed('+f_counter+');" name="Family['+ Family_rowCounter +'][unemployed]" class="unemployed"><label for="unemployed_'+f_counter+'"  class="mt-2 mb-2">عدم اشتغال</label></div></div><div class="col-12 col-md-2"><div class="people-forms-fields-group "><input type="text" id="organization_'+f_counter+'" name="Family['+ Family_rowCounter +'][organization]" class="organization form-control people-forms-fields"><label>سازمان/صنف</label></div></div></div>';
            $("table.family-table tbody").append(tmp);

        });

        $(document).on('click', 'button.remove-row', function () {
            $(this).closest('.row').remove();
            return false;
        });

        $(document).on('click', 'button.remove-row', function () {
            $(this).closest('row').remove();
            return false;
        });


        if ($(window).width() < 992) {
            $(document).ready(function () {

                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top - 20
                }, 'slow');
            });
        }


        $(document).ready(function () {

            $(".close-error").click(function () {
                $(".bg-error").hide();
                return false;
            });
            sickness_onchange();

            crime_onchange();
        });
        var introducer_rowCounter ={{$d}};
        //$(document).ready(function() {


        /////////////// sabeghe mahkomiat hide and show

        $('.mahkomiat').bind('change', function (e) {
            var crime = $('.crime-select:checked').val();
            if (crime == '1') {
                $('#crime_description').show();
            } else if (crime != '1') {
                $('#crime_description').hide();
            }
        });

        /////////////// sabeghe jarahi hide and show

        $('.jarahi').bind('change', function (e) {
            if ($('.sabghejarahi-select').val() == '0') {
                $('.namebimary').show();

            } else if ($('.sabghejarahi-select').val()) {
                $('.namebimary').hide();

            }
        });

        /////////////// karkonan golrang ro mishnasid hide and show

        $('.mishnasid').bind('change', function (e) {
            if ($('.kasiramishnasid-select').val() == '1') {
                $('.introducer').show();
            } else if ($('.kasiramishnasid-select').val()) {
                $('.introducer').hide();
            }
        });


        $(".add-row-introducer").click(function () {
            introducer_rowCounter++;
            var tmp = '<div class="row col-md-12 p-0 m-0"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/></button></div><div class="col-md-3"><div class="people-forms-fields-group"><div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div><input type="text" data-validation="required" name="introducer[' + introducer_rowCounter + '][name]" id="introducer[' + introducer_rowCounter + '][name]" class="name people-forms-fields form-control"><label>نام و نام خانوادگی</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div><input type="text" data-validation="required" name="introducer[' + introducer_rowCounter + '][company]" id="introducer[' + introducer_rowCounter + '][company]" class="company people-forms-fields form-control"><label>نام شرکت فعلی</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div><input type="text" data-validation="required" name="introducer[' + introducer_rowCounter + '][relation]" id="introducer[' + introducer_rowCounter + '][relation]" class="relation people-forms-fields form-control"><label>نسبت</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div><input type="text" data-validation="required" name="introducer[' + introducer_rowCounter + '][post]" id="introducer[' + introducer_rowCounter + '][post]" class="post people-forms-fields form-control"><label>عنوان شغلی </label></div></div></div>';
            $(".tableintroducer").append(tmp);
        });


        function intro_onchange() {
            var i = 0;
            var intro = $('.kasiramishnasid-select:checked').val();
            if (intro == '1') {
                $('#intro_span').show();
                for (i = 1; i < 100; i++) {
                    if ($('#introducer[' + i + '][name]')) {
                        $('#introducer[' + i + '][name]').attr('data-validation', 'required');
                    }
                    if ($('#introducer[' + i + '][company]')) {
                        $('#introducer[' + i + '][company]').attr('data-validation', 'required');
                    }
                    if ($('#introducer[' + i + '][relation]')) {
                        $('#introducer[' + i + '][relation]').attr('data-validation', 'required');
                    }
                    if ($('#introducer[' + i + '][post]')) {
                        $('#introducer[' + i + '][post]').attr('data-validation', 'required');
                    }
                }

            } else {
                $('#intro_span').hide();
                for (i = 1; i < 100; i++) {
                    if ($('#introducer[' + i + '][name]')) {
                        $('#introducer[' + i + '][name]').attr('data-validation', '');
                    }
                    if ($('#introducer[' + i + '][company]')) {
                        $('#introducer[' + i + '][company]').attr('data-validation', '');
                    }
                    if ($('#introducer[' + i + '][relation]')) {
                        $('#introducer[' + i + '][relation]').attr('data-validation', '');
                    }
                    if ($('#introducer[' + i + '][post]')) {
                        $('#introducer[' + i + '][post]').attr('data-validation', '');
                    }
                }
            }
        }

        intro_onchange();

        function crime_onchange() {
            var crime = $('.crime-select:checked').val();
            if (crime == '1') {
                $('#mahkomiat_span').show();
                $('#crime_description').show();
                $('#crime_description').attr('data-validation', 'required');
            } else {
                $('#mahkomiat_span').hide();
                $('#crime_description').hide();
                $('#crime_description').attr('data-validation', '');
            }
        }

        function sickness_onchange() {

            var sickness = $('.sabghejarahi-select:checked').val();
            if (sickness == '1') {
                $('#sickness_description_span').show();
                $('#sickness_treatment_span').show();
                $('#sickness_description').attr('data-validation', 'required');
            } else {
                $('#sickness_description_span').hide();
                $('#sickness_treatment_span').hide();
                $('#sickness_description').attr('data-validation', '');
            }
        }


        /*$('.form-control').delegate('.people-forms-fields', 'mouseout', function() {
            alert();
            checkValue(this);
        })*/

    </script>

@endsection