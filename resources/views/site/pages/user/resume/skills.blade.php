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
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: آموزشها و مهارتها
@endsection

@section('content')

    @php
        $provinces_html_list_js=null;
        $provinces_html_list_js='<select data-validation="required" name="city" data-placeholder=""  class="ostan-select  form-control" style="width:auto;" ><option value="">یک استان را انتخاب کنید</option>';
            foreach($provinces as $province){
            $provinces_html_list_js.='<option value="'.$province->name.'" >'.$province->name.'</option>';
            }
            $provinces_html_list_js.='</select>';
    @endphp


    @include('site.pages.user.side_bar')

    {{ Form::open(array('method'=>'PUT','route' => 'user.resume.4.store','id'=>'resume2form')) }}

    <div class="container" id="scroll-resume">
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
@endsection
@section('script')
    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}
    <script>
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


        $(document).on('click', 'button.remove-row', function () {
            $(this).closest('.row').remove();
            return false;
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

        /*    $('#resume2form').on('submit', function() {
                // reset error array
                var errors = [];
                if( !$(this).isValid() ) {
                    //displayErrors( errors );
                    alert('یک خطا در صفحه ی شما وجود دارد');
                } else {
                    // The form is valid
                }
            });*/
        setTimeout("$('.chosen-container').attr('style','width:100%');", 1000);
    </script>
@endsection