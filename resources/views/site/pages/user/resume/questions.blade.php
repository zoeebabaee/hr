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
    {{ Form::open(array('method'=>'PUT','route' => 'user.resume.4.store','id'=>'resume2form')) }}
    <div class="container" id="scroll-resume-skill">
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
        @include('site.modules.resumeCompleteLine')
        <fieldset class="red-fieldset mt-7">
            <div class="float-left font-13 red-fieldset-left dir-ltr"><img class="mr-2"
                                                                           src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>پر کردن آیتم های</span><img
                        class="m-2" src="/site/default/Template_2019/img/Group 166.svg"/><span> اجباری است</span></div>
            <legend>سوابق آموزشی تخصصی</legend>
        </fieldset>
        <div class="clearfix">
            <table class="ProfesstionalTrainingRecords-table" style="direction: rtl;">
                <tbody>
                @php
                    $c=10;
                    $edu=null;
                @endphp
                {{--
                @if($resume->professional_training_records->count()==0)
                <div class="people-forms people-forms-fields-group row">
                    <div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span></button></div>
                    <div class="col-md-3"><div class="people-forms-fields-group"><input  data-validation="required" type="text" value="" name="ProfesstionalTrainingRecords[{{$c}}][title]" class="title people-forms-fields form-control"><label>عنوان دوره/گواهینامه تخصصی	</label></div></div>
                    <div class="col-md-2"><div class="people-forms-fields-group"><input  data-validation="required" type="text" value=""  name="ProfesstionalTrainingRecords[{{$c}}][duration]" class="duration people-forms-fields form-control"><label>مدت دوره(ساعت)	</label></div></div>
                    <div class="col-md-2"><div class="people-forms-fields-group"><input  data-validation="required" type="text" value="" name="ProfesstionalTrainingRecords[{{$c}}][endDate]" class="endDate people-forms-fields form-control"><label>سال اتمام	</label></div></div>
                    <div class="col-md-2"><div class="people-forms-fields-group"><input  data-validation="" data-validation-format="yyyy/mm/dd" type="text" value="" name="ProfesstionalTrainingRecords[{{$c}}][instituteName]" class="instituteName form-control"><label>نام آموزشگاه/مؤسسه</label></div></div>
                    <div class="col-md-2 people-forms-fields-group"><input value="1" type="checkbox" name="ProfesstionalTrainingRecords[{{$c}}][hasCertificate]" class="hasCertificate" id="hasCertificateInput-1"><label for="hasCertificateInput-1">امکان ارائه گواهینامه	</label></div>
                </div>
                @else
                --}}
                @foreach($resume->professional_training_records as $edu)

                    @php
                        $c++;
                    @endphp

                    <div class="people-forms people-forms-fields-group row">
                        <div class="col-md-1">
                            <button type="button" class="remove-row" title="Remove row"><img
                                        src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span></button>
                        </div>
                        <div class="col-md-3">
                            <div class="people-forms-fields-group"><input data-validation="required" type="text"
                                                                          value="{{$edu->name}}"
                                                                          name="ProfesstionalTrainingRecords[{{$c}}][title]"
                                                                          class="title people-forms-fields form-control"><label>عنوان
                                    دوره/گواهینامه تخصصی</label></div>
                        </div>
                        <div class="col-md-2">
                            <div class="people-forms-fields-group"><input data-validation="required" type="text"
                                                                          value="{{$edu->pivot->duration}}"
                                                                          name="ProfesstionalTrainingRecords[{{$c}}][duration]"
                                                                          class="duration people-forms-fields form-control"><label>مدت
                                    دوره(ساعت)</label></div>
                        </div>
                        <div class="col-md-2">
                            <div class="people-forms-fields-group"><input data-validation="required number"
                                                                          placeholder="13xx"
                                                                          data-validation-allowing="negative"
                                                                          data-validation-format="yyyy/mm/dd"
                                                                          type="text"
                                                                          value="{{$edu->pivot->finish_year}}"
                                                                          name="ProfesstionalTrainingRecords[{{$c}}][endDate]"
                                                                          id="ProfesstionalTrainingRecords[{{$c}}][endDate]"
                                                                          class="endDate people-forms-fields form-control"><label>سال
                                    اتمام</label></div>
                        </div>
                        <div class="col-md-2">
                            <div class="people-forms-fields-group"><input data-validation="required" type="text"
                                                                          value="{{$edu->pivot->institute_name}}"
                                                                          name="ProfesstionalTrainingRecords[{{$c}}][instituteName]"
                                                                          class="instituteName people-forms-fields form-control"><label>نام
                                    آموزشگاه/مؤسسه</label></div>
                        </div>
                        <div class="col-md-2 people-forms-fields-group"><input type="checkbox" value="1"
                                                                               {{($edu->pivot->has_certificate==1?' checked ':'')}} name="ProfesstionalTrainingRecords[{{$c}}][hasCertificate]"
                                                                               id="ProfesstionalTrainingRecords[{{$c}}][hasCertificate]"
                                                                               class="hasCertificate"><label
                                    for="ProfesstionalTrainingRecords[{{$c}}][hasCertificate]">امکان ارائه
                                گواهینامه</label></div>
                    </div>

                @endforeach
                {{--
                @endif
                --}}

                </tbody>
            </table>
            <div>
                <button type="button" class="add-row-ProfesstionalTrainingRecords add-row-btn mt-4" title="Add Row"><img
                            src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span></button>
            </div>
            <div class="col-xs-12">
                <fieldset class="red-fieldset mt-7">
                    <legend>آشنایی با زبان های خارجی</legend>
                </fieldset>
                <div class="col-xs-12 no-padd no-padd-xs">
                    <div>
                        <table class="ForeignLanguage-table" style="direction: rtl;">
                            <tbody>
                            @php
                                $c=10;
                                $edu=null;
                            @endphp

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <input type="text" readonly="readonly" value="انگلیسی"
                                               name="ForeignLanguage[{{$c}}][title]"
                                               class="title people-forms-fields form-control">
                                        <label>زبان</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <select data-validation="required" name="ForeignLanguage[{{$c}}][speaking]"
                                                class="form-control people-forms-fields po-input-select">
                                            <option value="" {{(!is_null($english) && $english->conversation==""?'selected':'')}} ></option>
                                            <option value="1" {{(!is_null($english) && $english->conversation=="1"?' selected ':'')}}>
                                                عالی
                                            </option>
                                            <option value="2" {{(!is_null($english) && $english->conversation=="2"?' selected ':'')}}>
                                                خوب
                                            </option>
                                            <option value="3" {{(!is_null($english) && $english->conversation=="3"?' selected ':'')}}>
                                                متوسط
                                            </option>
                                            <option value="4" {{(!is_null($english) && $english->conversation=="4"?' selected ':'')}}>
                                                ضعیف
                                            </option>
                                        </select>
                                        <label>مکالمه</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <select data-validation="required" name="ForeignLanguage[{{$c}}][writing]"
                                                class="form-control people-forms-fields po-input-select">
                                            <option value="" {{(!is_null($english) && $english->writing==""?' selected ':'')}}></option>
                                            <option value="1" {{(!is_null($english) && $english->writing=="1"?' selected ':'')}}>
                                                عالی
                                            </option>
                                            <option value="2" {{(!is_null($english) && $english->writing=="2"?' selected ':'')}}>
                                                خوب
                                            </option>
                                            <option value="3" {{(!is_null($english) && $english->writing=="3"?' selected ':'')}}>
                                                متوسط
                                            </option>
                                            <option value="4" {{(!is_null($english) && $english->writing=="4"?' selected ':'')}}>
                                                ضعیف
                                            </option>
                                        </select>
                                        <label>نگارش</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <select data-validation="required" name="ForeignLanguage[{{$c}}][comprehension]"
                                                class="form-control people-forms-fields po-input-select">
                                            <option value="" {{(!is_null($english) && $english->comprehension==""?' selected ':'')}}></option>
                                            <option value="1" {{(!is_null($english) && $english->comprehension=="1"?' selected ':'')}}>
                                                عالی
                                            </option>
                                            <option value="2" {{(!is_null($english) && $english->comprehension=="2"?' selected ':'')}}>
                                                خوب
                                            </option>
                                            <option value="3" {{(!is_null($english) && $english->comprehension=="3"?' selected ':'')}}>
                                                متوسط
                                            </option>
                                            <option value="4" {{(!is_null($english) && $english->comprehension=="4"?' selected ':'')}}>
                                                ضعیف
                                            </option>
                                        </select>
                                        <label>درک مطلب</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <input data-validation="" type="text"
                                               value="{{(!is_null($english) ?$english->certificate:'')}}"
                                               name="ForeignLanguage[{{$c}}][Certificate]"
                                               class="Certificate people-forms-fields form-control">
                                        <label>گواهینامه</label>
                                    </div>
                                </div>
                            </div>


                            @foreach($resume->foreign_languages as $edu)
                                @if($edu->title == 'انگلیسی')
                                    @continue
                                @endif

                                @php
                                    $c++;
                                @endphp
                                <div class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="remove-row" title="Remove row"><img
                                                    src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span>
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="ForeignLanguage[{{$c}}][title]" class="title chosen">
                                            @foreach($languages as $lang)
                                                <option value="{{$lang}}" @php if($lang == $edu->title){echo ' selected ';} @endphp >{{$lang}}</option>
                                            @endforeach
                                        </select>
                                        <label class="chosen-drop-label">زبان</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="people-forms-fields-group">
                                            <select data-validation="required" name="ForeignLanguage[{{$c}}][speaking]"
                                                    class="form-control people-forms-fields po-input-select">
                                                <option value=""{{($edu->conversation==""?' selected ':'')}}></option>
                                                <option value="1"{{($edu->conversation==1?' selected ':'')}}>عالی
                                                </option>
                                                <option value="2"{{($edu->conversation==2?' selected ':'')}}>خوب
                                                </option>
                                                <option value="3"{{($edu->conversation==3?' selected ':'')}}>متوسط
                                                </option>
                                                <option value="4"{{($edu->conversation==4?' selected ':'')}}>ضعیف
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="people-forms-fields-group">
                                            <select data-validation="required" name="ForeignLanguage[{{$c}}][writing]"
                                                    class="form-control people-forms-fields po-input-select">
                                                <option value=""{{($edu->writing==""?' selected ':'')}}></option>
                                                <option value="1"{{($edu->writing==1?' selected ':'')}}>عالی</option>
                                                <option value="2"{{($edu->writing==2?' selected ':'')}}>خوب</option>
                                                <option value="3"{{($edu->writing==3?' selected ':'')}}>متوسط</option>
                                                <option value="4"{{($edu->writing==4?' selected ':'')}}>ضعیف</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="people-forms-fields-group">
                                            <select data-validation="required"
                                                    name="ForeignLanguage[{{$c}}][comprehension]"
                                                    class="form-control people-forms-fields po-input-select">
                                                <option value=""{{($edu->comprehension==""?' selected ':'')}}></option>
                                                <option value="1"{{($edu->comprehension==1?' selected ':'')}}>عالی
                                                </option>
                                                <option value="2"{{($edu->comprehension==2?' selected ':'')}}>خوب
                                                </option>
                                                <option value="3"{{($edu->comprehension==3?' selected ':'')}}>متوسط
                                                </option>
                                                <option value="4"{{($edu->comprehension==4?' selected ':'')}}>ضعیف
                                                </option>
                                            </select>
                                            <label>درک مطلب</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="people-forms-fields-group">
                                            <input data-validation="" type="text" value="{{$edu->certificate}}"
                                                   name="ForeignLanguage[{{$c}}][Certificate]"
                                                   class="Certificate people-forms-fields form-control">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <button type="button" class="add-row-ForeignLanguage add-row-btn mt-4" title="Add Row"><img
                                        src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <fieldset class="red-fieldset mt-7">
                    <legend>آشنایی با کامپیوتر</legend>
                </fieldset>
                <div class="col-xs-12 no-padd no-padd-xs">
                    <div>
                        <table class="computerSkill-table" style="direction: rtl;">
                            <tbody>
                            @php
                                $c=10;
                                $edu=null;
                            @endphp
                            {{--
                            @if($resume->computer_skills->count()==0)
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span></button>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <input data-validation="required" type="text" value="" name="computerSkill[{{$c}}][title]" class="title form-control people-forms-fields">
                                        <label>نام نرم افزار</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <select data-validation="required" name="computerSkill[{{$c}}][proficiency]" class="form-control people-forms-fields">
                                            <option value="1">عالی</option>
                                            <option value="2">خوب</option>
                                            <option value="3">متوسط</option>
                                            <option value="4">ضعیف</option>
                                        </select>
                                        <label>میزان تسلط</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <input type="text" value="" name="computerSkill[{{$c}}][description]" class="description form-control people-forms-fields">
                                        <label>توضیحات</label>
                                    </div>
                                </div>
                                <div class="col-md-2 people-forms-fields-group">
                                    <input type="checkbox" name="computerSkill[{{$c}}][Certificate]" id="certifi_[{{$c}}][Certificate]_3" value="1">
                                    <label for="certifi_[{{$c}}][Certificate]_3">امکان ارائه گواهینامه	</label>
                                </div>
                            </div>
                            @else
                            --}}
                            @foreach($resume->computer_skills as $edu)
                                @php
                                    $c++;
                                @endphp
                                <div class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="remove-row" title="Remove row"><img
                                                    src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="people-forms-fields-group">
                                            <input data-validation="required" type="text" value="{{$edu->name}}"
                                                   name="computerSkill[{{$c}}][title]"
                                                   class="title form-control people-forms-fields">
                                            <label>نام نرم افزار</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="people-forms-fields-group">
                                            <select data-validation="required" name="computerSkill[{{$c}}][proficiency]"
                                                    class="form-control people-forms-fields po-input-select">
                                                <option value=""{{($edu->pivot->proficiency==""?'':'')}}></option>
                                                <option value="1"{{($edu->pivot->proficiency==1?' selected ':'')}}>
                                                    عالی
                                                </option>
                                                <option value="2"{{($edu->pivot->proficiency==2?' selected ':'')}}>خوب
                                                </option>
                                                <option value="3"{{($edu->pivot->proficiency==3?' selected ':'')}}>
                                                    متوسط
                                                </option>
                                                <option value="4"{{($edu->pivot->proficiency==4?' selected ':'')}}>
                                                    ضعیف
                                                </option>
                                            </select>
                                            <label>میزان تسلط</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="people-forms-fields-group">
                                            <input type="text" value="{{$edu->pivot->description}}"
                                                   name="computerSkill[{{$c}}][description]"
                                                   class="description people-forms-fields form-control">
                                            <label>توضیحات</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 people-forms-fields-group">
                                        <input type="checkbox"
                                               {{($edu->pivot->has_certificate==1?' checked ':'')}} name="computerSkill[{{$c}}][Certificate]"
                                               id="certifi_[{{$c}}][Certificate]_4" value="1">
                                        <label for="certifi_[{{$c}}][Certificate]_4">امکان ارائه گواهینامه</label>
                                    </div>
                                </div>

                            @endforeach
                            {{--
                            @endif
                            --}}
                            </tbody>
                        </table>
                        <div>
                            <button type="button" class="add-row-computerSkill add-row-btn mt-4" title="Add Row"><img
                                        src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <fieldset class="red-fieldset mt-7">
                    <legend> در صورتی که به صورت تجربی، تخصص یا مهارتی کسب کرده اید، در این قسمت قید نمایید</legend>
                </fieldset>
                <div class="col-xs-12 no-padd no-padd-xs">
                    <div>
                        <table class="experimental-table" style="direction: rtl;">
                            <tbody>
                            @php
                                $c=10;
                                $edu=null;
                            @endphp
                            {{--
                            @if($resume->experimental_expertises->count()==0)
                            <div class="row">
                                <div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span></butto</button></div>
                                <div class="col-md-4"><div class="people-forms-fields-group"><input data-validation="required" type="text" value="" name="experimental[{{$c}}][title]" class="title people-forms-fields form-control"><label>عنوان</label></div></div>
                                <div class="col-md-3">
                                    <div class="people-forms-fields-group">
                                        <select data-validation="required" name="experimental[{{$c}}][proficiency]" class="form-control people-forms-fields po-input-select">
                                            <option value=""></option>
                                            <option value="1">عالی</option>
                                            <option value="2">خوب</option>
                                            <option value="3">متوسط</option>
                                            <option value="4">ضعیف</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="people-forms-fields-group">
                                        <input type="text" value="" name="experimental[{{$c}}][description]" class="description people-forms-fields form-control">
                                        <label>توضیحات</label>
                                    </div>
                                </div>
                            </div>
                            @else
                            --}}
                            @foreach($resume->experimental_expertises as $edu)

                                @php
                                    $c++;
                                @endphp
                                <div class="row">
                                    <div class="col-md-1">
                                        <button type="button" class="remove-row" title="Remove row"><img
                                                    src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span>
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="people-forms-fields-group"><input data-validation="required"
                                                                                      type="text" value="{{$edu->name}}"
                                                                                      name="experimental[{{$c}}][title]"
                                                                                      class="title people-forms-fields form-control"><label>عنوان</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="people-forms-fields-group">
                                            <select data-validation="required" name="experimental[{{$c}}][proficiency]"
                                                    class="form-control people-forms-fields po-input-select">
                                                <option value=""{{$edu->pivot->proficiency==""?' selected ':''}}></option>
                                                <option value="1"{{$edu->pivot->proficiency==1?' selected ':''}}>عالی
                                                </option>
                                                <option value="2"{{$edu->pivot->proficiency==2?' selected ':''}}>خوب
                                                </option>
                                                <option value="3"{{$edu->pivot->proficiency==3?' selected ':''}}>متوسط
                                                </option>
                                                <option value="4"{{$edu->pivot->proficiency==4?' selected ':''}}>ضعیف
                                                </option>
                                            </select>
                                            <label>میزان تسلط</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="people-forms-fields-group">
                                            <input type="text" value="{{$edu->pivot->description}}"
                                                   name="experimental[{{$c}}][description]"
                                                   class="description people-forms-fields form-control">
                                            <label>توضیحات</label>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            {{--
                            @endif
                            --}}

                            </tbody>
                        </table>
                        <div>
                            <button type="button" class="add-row-experimental add-row-btn mt-4" title="Add Row"><img
                                        src="/site/default/Template_2019/img/add-row-btn.svg"/><span>افزودن سطر جدید</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="mt-5 w-100">
            <legend class="text-left">
                <input type="submit" class="save send-btn-green" title="ذخیره و ادامه"
                       value="<?= (Auth::user()->complete_percent != 31) ? 'ذخیره و ادامه' : 'ذخیره' ?>">
            </legend>
        </fieldset>
        {{Form::close()}}
    </div>
          <div class="container">
  






              <fieldset class="red-fieldset mt-7">
                  <div class="float-left font-13 red-fieldset-left dir-ltr"><img class="mr-2" src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>پر کردن آیتم های</span><img class="m-2" src="/site/default/Template_2019/img/Group 166.svg" /><span> اختیاری است</span></div>
                  <legend> اطلاعات تکمیلی  </legend>
              </fieldset>
              {{ Form::open(array('method'=>'POST','files'=>true,'route' => 'site.user.profile.update_linkdin_address')) }}
<div class="row">
         <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <input type="text" name="linkedin"
                               value="@if(Auth::user()->profile->linkedin!=null){{Auth::user()->profile->linkedin}}@else{{old('linkedin')}}@endif"
                               class="national_id form-control people-forms-fields" id="linkedin"/>
                        <label>آدرس پروفایل لینکدین</label>
                        <span id="linkedin-help" style="color:#Ab4442;"></span>
                    </div>
                    

         </div>
         
         <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div id="drag-and-drop-zone" class="clearfix uploader">
                            <div class="clearfix browser">
                                <label id="delete_file">
                                    <span><i class="fa fa-times" style="vertical-align: middle;"></i></span>
                                </label>
                                @if(Storage::disk('resume')->exists('cv/'.\HR\myFuncs::spilit_string(Auth::user()->id).'/resume.pdf'))
                                    <a id="cv_link" href="{{route('cv.show',Auth::user()->id)}}" target="_blank"><span
                                                id="cv_label">مشاهده فایل آپلود شده</span></a>
                                @else
                                    <div onclick="$('#cv').click()"
                                         style="color: #000;float: right;padding: 8px 10px;font-size: 14px;"
                                         id="cv_label">رزومه خود را آپلود کنید.
                                    </div>
                                @endif
                                <label>
                                    <span><i class="fa fa-cloud-upload"></i></span>
                                    <input type="file" accept="application/pdf" id="cv" name="cv"
                                           onchange=" document.getElementById('cv_label').innerHTML = this.value;"
                                           title="کلیک کنید و فایل مورد نظر را انتخاب کنید">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
         
    <div class="col-md-4 form-group">
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}        
         
     </div>
     </div>
        {{Form::close()}}
       
        

    </div>
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
                <div class="float-left font-13 red-fieldset-left dir-ltr"><img class="mr-2" src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>پر کردن آیتم های</span><img class="m-2" src="/site/default/Template_2019/img/Group 166.svg" /><span> اجباری است</span></div>
                <legend> نام و مشخصات شغلی اعضای خانواده</legend>
            </fieldset>
            @php
                $c=1;
            @endphp
            {{--<p style="color:red" class="mt-3 text-right">جهت حضور در مصاحبه منابع انسانی، درج اطلاعات کلیه بستگان درجه اول، ضروری میباشد.</p>--}}
            @if($resume->family->count()==0)
                <div class="wrapper-family-table">

                    <table class="family-table">
                        <div class="row family-table">
                            <div class="col-md-2">
                                <div class="people-forms-fields-group">
                                    <input type="text" value="" name="Family[{{$c}}][first_name]"
                                           class="name form-control people-forms-fields form-control">
                                    <label>نام </label>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="people-forms-fields-group">
                                    <input type="text" value="" name="Family[{{$c}}][last_name]"
                                           class="name form-control people-forms-fields form-control">
                                    <label>نام خانوادگی</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="people-forms-fields-group">
                                    <select data-validation="required" data-placeholder="یک گزینه انتخاب کنید"
                                            name="Family[{{$c}}][relation]"
                                            class="relation-select form-control people-forms people-forms-fields">
                                        <option value="">انتخاب کنید...</option>
                                        
                                        
                                        @foreach($relations as $key=>$relation)
                            <option value={{$key}}>{{$relation['name']}}
                                </option>
                            @endforeach
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
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <input data-validation="required" type="text" value="@if($family->first_name == null) {{$family->name}} @else{{$family->first_name}}@endif"
                                               name="Family[{{$c}}][first_name]"
                                               class="name form-control people-forms people-forms-fields">
                                        <label>نام و نام خانوادگی</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="people-forms-fields-group">
                                        <input data-validation="required" type="text" value="{{$family->last_name}}"
                                               name="Family[{{$c}}][last_name]"
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
                                         @foreach($relations as $key=>$relation)
                                     <option value={{$key}} {{($family->relation==$key?' selected ':'')}} >{{$relation['name']}}
                                     </option>
                                @endforeach
                                        </select>
                                        <label>نسبت</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
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
@endsection

@section('script')

    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/dmuploader.js') }}

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
            var options ;
            
             @foreach($relations as $key=>$relation)
                 options +="<option value={{$key}}>{{$relation['name']}}</option>"
             @endforeach
            
            f_counter++;
            Family_rowCounter++;
var tmp = '<div class="row"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/></button></div><div class="col-md-2"><div class="people-forms-fields-group"><input data-validation="" type="text" name="Family['+ Family_rowCounter +'][first_name]" class="name form-control people-forms people-forms-fields "><label>نام </label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><input data-validation="" type="text" name="Family['+ Family_rowCounter +'][last_name]" class="name form-control people-forms people-forms-fields "><label>نام خانوادگی</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><select data-validation="required" data-placeholder="یک گزینه انتخاب کنید" name="Family['+ Family_rowCounter +'][relation]" class="relation-select people-forms people-forms-fields"><option value="">یک گزینه را انتخاب کنید</option>'+options+'</select><label>نسبت</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><input type="text" id="job_'+f_counter+'" name="Family['+ Family_rowCounter +'][job]" class="job form-control people-forms-fields"><label>شغل</label><input type="checkbox" id="unemployed_'+f_counter+'" onclick="unemployed('+f_counter+');" name="Family['+ Family_rowCounter +'][unemployed]" class="unemployed"><label for="unemployed_'+f_counter+'"  class="mt-2 mb-2">عدم اشتغال</label></div></div><div class="col-12 col-md-2"><div class="people-forms-fields-group "><input type="text" id="organization_'+f_counter+'" name="Family['+ Family_rowCounter +'][organization]" class="organization form-control people-forms-fields"><label>سازمان/صنف</label></div></div></div>';

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
        
            $('#delete_file').on('click', function () {
            $('#cv').val('');
            $('#cv_label').html('رزومه خود را آپلود کنید.');
            $('#cv_link').removeAttr('href').attr('onclick', "$('#cv').click()");
        });

        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume-skill').offset().top - 20
                }, 'slow');
            });
        }



    </script>

    <script>


        //skill
        var tendency_old_val = null;

        function tendency(id) {
            var chk = $('#tendency_check_' + id).is(':checked');
            if (chk) {
                tendency_old_val = $('#tendency_' + id).val();
                $('#tendency_' + id).val('');
                $('#tendency_' + id).attr('disabled', true);
                $('#tendency_' + id).attr('data-validation', '');
                $('#tendency_' + id).removeClass('error');
                $('#tendency_' + id).parent().next("span").remove();
            } else {
                $('#tendency_' + id).val(tendency_old_val);
                $('#tendency_' + id).attr('disabled', false);
                $('#tendency_' + id).attr('data-validation', 'required');
            }
        }


        $(document).ready(function () {
            $('.chosen').chosen();
            $(".close-error").click(function () {
                $(".bg-error").hide();
                return false;
            });
        });

        var ProfesstionalTrainingRecords_rowCounter ={{($resume->professional_training_records->count()==0?10:$resume->professional_training_records->count())}};
        var ForeignLanguage_rowCounter ={{($resume->foreign_languages->count()==0?10:$resume->foreign_languages->count())}};
        var computerSkill_rowCounter ={{($resume->computer_skills->count()==0?10:$resume->computer_skills->count())}};
        var experimental_rowCounter = {{($resume->experimental_expertises->count()==0?10:$resume->experimental_expertises->count())}};
        $(".add-row-ProfesstionalTrainingRecords").click(function () {
            ProfesstionalTrainingRecords_rowCounter++;
            var tmp = '<div class="people-forms people-forms-fields-group row"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span></button></div><div class="col-md-3"><div class="people-forms-fields-group"><input data-validation="required" type="text" name="ProfesstionalTrainingRecords[' + ProfesstionalTrainingRecords_rowCounter + '][title]" class="title people-forms-fields form-control"><label>عنوان دوره/گواهینامه تخصصی	</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><input data-validation="required" type="text" name="ProfesstionalTrainingRecords[' + ProfesstionalTrainingRecords_rowCounter + '][duration]" class="duration people-forms-fields form-control"><label>مدت دوره(ساعت)	</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><input type="text" data-validation="required number" placeholder="13xx" data-validation-allowing="negative" name="ProfesstionalTrainingRecords[' + ProfesstionalTrainingRecords_rowCounter + '][endDate]" id="ProfesstionalTrainingRecords[' + ProfesstionalTrainingRecords_rowCounter + '][endDate]" class="endDate people-forms-fields form-control text-left"><label>سال اتمام</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><input type="text" data-validation="required" name="ProfesstionalTrainingRecords[' + ProfesstionalTrainingRecords_rowCounter + '][instituteName]" class="instituteName people-forms-fields form-control"><label>نام آموزشگاه/مؤسسه</label></div></div><div class="col-md-2 people-forms-fields-group"><input type="checkbox" value="1" name="ProfesstionalTrainingRecords[' + ProfesstionalTrainingRecords_rowCounter + '][hasCertificate]" class="hasCertificate" id="certifi[' + ProfesstionalTrainingRecords_rowCounter + ']_2"><label for="certifi[' + ProfesstionalTrainingRecords_rowCounter + ']_2">امکان ارائه گواهینامه	</label></div></div>';
            $("table.ProfesstionalTrainingRecords-table tbody").append(tmp);

            $.validate({
                modules: 'date',
                lang: 'fa'
            });
        });


        $(".add-row-ForeignLanguage").click(function () {

            ForeignLanguage_rowCounter++;
            var tmp = '<div class="row"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/></div><div class="col-md-2"><div class="people-forms-fields-group"><select data-specify-type="title"  id="chosen_lang_'+ForeignLanguage_rowCounter+'" name="ForeignLanguage['+ForeignLanguage_rowCounter+'][title]" class="text chosen people-forms-fields po-input-select"><option>انتخاب کنید</option>@foreach($languages as $lang)<option value="{{$lang}}">{{$lang}}</option>@endforeach</select><label class="chosen-drop-label">زبان</label>                            <span style="display:none" class="help-block"></span>           </div></div><div class="col-md-2"><div class="people-forms-fields-group"><select onclick=alert(ff) data-validation="required" class="form-control people-forms-fields po-input-select" name="ForeignLanguage['+ForeignLanguage_rowCounter+'][speaking]"><option value="">انتخاب کنید</option><option value="1">عالی</option><option value="2">خوب</option><option value="3">متوسط</option><option value="4">ضعیف</option></select><label>مکالمه</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><select data-validation="required" class="form-control people-forms-fields po-input-select" name="ForeignLanguage['+ForeignLanguage_rowCounter+'][writing]"><option value="">انتخاب کنید</option><option value="1">عالی</option><option value="2">خوب</option><option value="3">متوسط</option><option value="4">ضعیف</option></select><label>نگارش</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><select data-validation="required" class="people-forms-fields po-input-select form-control" name="ForeignLanguage['+ForeignLanguage_rowCounter+'][comprehension]"><option value="">انتخاب کنید</option><option value="1">عالی</option><option value="2">خوب</option><option value="3">متوسط</option><option value="4">ضعیف</option></select><label>درک مطلب</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><input data-validation="" type="text" name="ForeignLanguage['+ForeignLanguage_rowCounter+'][Certificate]" class="Certificate people-forms-fields form-control"><label>گواهینامه</label></div></div></div>';

            $("table.ForeignLanguage-table tbody").append(tmp);
            $('#chosen_lang_' + ForeignLanguage_rowCounter).chosen();
            $('#chosen_lang_' + ForeignLanguage_rowCounter).trigger("chosen:updated");
            $('.chosen-container').attr('style', 'width:100%');
            $.validate({
                modules: 'date',
                lang: 'fa'
            });
        });


        $(".add-row-computerSkill").click(function () {
            computerSkill_rowCounter++;
            var tmp = '<div class="row"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span></button></div><div class="col-md-3"><div class="people-forms-fields-group"><input data-validation="required" type="text" name="computerSkill['+computerSkill_rowCounter+'][title]" class="title people-forms-fields form-control"><label>نام نرم افزار</label></div></div><div class="col-md-2"><div class="people-forms-fields-group"><select data-validation="required" class="form-control people-forms-fields po-input-select" name="computerSkill['+computerSkill_rowCounter+'][proficiency]"><option value="">انتخاب کنید</option><option value="1">عالی</option><option value="2">خوب</option><option value="3">متوسط</option><option value="4">ضعیف</option></select><label>میزان تسلط</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><input type="text" name="computerSkill['+computerSkill_rowCounter+'][description]" class="description people-forms-fields form-control"><label>توضیحات</label></div></div><div class="col-md-3 people-forms-fields-group"><input type="checkbox" name="computerSkill['+computerSkill_rowCounter+'][Certificate]" value="1"><label for="certifi_[{{$c}}][Certificate]_3">امکان ارائه گواهینامه\t</label></div></div>';
            $("table.computerSkill-table tbody").append(tmp);
            $.validate({
                modules: 'date',
                lang: 'fa'
            });
        });


        $(".add-row-experimental").click(function () {
            experimental_rowCounter++;
            var tmp = '<div class="row"><div class="col-md-1"><button type="button" class="remove-row" title="Remove row"><img src="/site/default/Template_2019/img/remove-row-btn.svg"/><span></span></button></div><div class="col-md-4"><div class="people-forms-fields-group"><input data-validation="required" type="text" name="experimental['+experimental_rowCounter+'][title]" class="title people-forms-fields form-control"><label>عنوان</label></div></div><div class="col-md-3"><div class="people-forms-fields-group"><select data-validation="required" class="form-control people-forms-fields po-input-select"  name="experimental['+experimental_rowCounter+'][proficiency]"><option value="">انتخاب کنید</option><option value="1">عالی</option><option value="2">خوب</option><option value="3">متوسط</option><option value="4">ضعیف</option></select><label>میزان تسلط</label></div></div><div class="col-md-4"><div class="people-forms-fields-group"><input type="text" name="experimental['+experimental_rowCounter+'][description]" class="description people-forms-fields form-control"><label>توضیحات</label></div></div></div>';
            $("table.experimental-table tbody").append(tmp);
            $.validate({
                modules: 'date',
                lang: 'fa'
            });
        });



        $(".send-btn-green").click(function () {

                if ($('li.active-result').text() == "")
                {
                    if($('select[data-specify-type="title"]').val() == 'انتخاب کنید')

                    { $('.help-block').show()
                        $('.help-block').text("فیلد ضروری")
                        return false;}

                }
            }
        );

        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top - 20
                }, 'slow');
            });
        }
        //skill



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