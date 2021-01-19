<style>

    .support_hide
    {
        display: none;
    }

</style>

<div class="menu-under-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/user/profile"><i class="fa fa-list-alt" style="font-size: 15px;"></i> فرم استخدام </a>
                    </li>
                    @if(Auth::user()->resume)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.resume.preview',time())}}">
                        <i class="fa fa-download" style="font-size: 15px;"></i>
                            دانلود رزومه</a>
                    </li>
                    @endif
                    <li class="nav-item" data-intro="لیست فرصت های شغلی را مشاهده و شغل مورد نظر را انتخاب فرمایید."  data-scrollTo="tooltip" data-position="bottom">
                        <a class="nav-link" href="{{route('site.jobs.index')}}">
                        <i class="fa fa-users" style="font-size: 15px;"></i>
                            فرصت های شغلی</a>
                    </li>
                    <li class="nav-item" data-intro="درخواست های ثبت شده ی خود را در منوی لیست درخواست ها بررسی و پیگیری نمایید"  data-scrollTo="tooltip" data-position="bottom">
                        <a class="nav-link" {!! (strpos(Route::currentRouteName(),'user.applies.list')!==false?' class="active-jobs" ':'') !!} href="{{route('user.applies.list')}}">
                        <i class="fa fa-list" style="font-size: 15px;"></i>
                        لیست درخواست ها</a>
                    </li>
                    @if(Auth::user()->tickets)

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.tickets.index')}}">مدیریت تیکت ها</a>
                    </li>
                    
                    @endif
                    
                    <li class="nav-item">
                    <a class="nav-link"  data-toggle="modal" data-target="#basicSupportModal" id="supoort_users" href="">
                        <i class="fa fa-phone" style="font-size: 15px;"></i>
                        پشتیبانی</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.favorite.jobs')}}" {!! (strpos(Route::currentRouteName(),'user.favorite.jobs')!==false?' class="active-jobs" ':'') !!}>
                        <i class="fa fa-bookmark" style="font-size: 15px;"></i>
                            لیست علاقه مندی ها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.user.profile.reset.password')}}">
                        <i class="fa fa-exchange" style="font-size: 15px;"></i>
                            تغییر رمز عبور</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out" style="font-size: 15px;"></i>خروج</a>
                    </li>
            </ul>
          </div>
        </nav>
    </div>
</div>

<div class="wizard-process">
    <hr>
    <div class="container">
        <div class="row">
            <div class="wizard-process-item">
                <a href="{{route('site.user.profile')}}" {!! (Route::currentRouteName()=='site.user.profile'?' class="active-jobs" ':'') !!}>
                @if(Auth::user()->profile)
                    <img src="/site/default/Template_2019/img/success.svg" />
                @else
                    <img src="/site/default/Template_2019/img/pending.svg" />
                @endif
                <span class="mr-2 font-14">اطلاعات فردی </span>
                </a>
            </div>
            <div class="wizard-process-item">
                <a {!! (Route::currentRouteName()=='user.resume.1'?' class="active-jobs" ':'') !!} href="{{route('user.resume.1')}}">
                @if(\HR\myFuncs::is_complete(Auth::user()->complete_percent,1))
                <img src="/site/default/Template_2019/img/success.svg" />
                @else
                <img src="/site/default/Template_2019/img/pending.svg" />
                @endif
                <span class="mr-2 font-14">مشخصات شغل</span>
                </a>
            </div>
            <div class="wizard-process-item">
                <a {!! (Route::currentRouteName()=='user.resume.2'?' class="active-jobs" ':'') !!}href="{{route('user.resume.2')}}">
                @if(\HR\myFuncs::is_complete(Auth::user()->complete_percent,2))
                <img src="/site/default/Template_2019/img/success.svg" />
                @else
                <img src="/site/default/Template_2019/img/pending.svg" />
                @endif
                <span class="mr-2 font-14">تحصیلات</span>
                </a>
            </div>
            <div class="wizard-process-item">
                <a {!! (Route::currentRouteName()=='user.resume.3'?' class="active-jobs" ':'') !!}href="{{route('user.resume.3')}}">
                    @if(\HR\myFuncs::is_complete(Auth::user()->complete_percent,4))
                        <img src="/site/default/Template_2019/img/success.svg" />
                    @else
                        <img src="/site/default/Template_2019/img/pending.svg" />
                    @endif
                <span class="mr-2 font-14">سوابق شغلی</span>
                </a>
            </div>
            <div class="wizard-process-item">
                <a {!! (Route::currentRouteName()=='user.resume.4'?' class="active-jobs" ':'') !!}href="{{route('user.resume.4')}}">
                @if(\HR\myFuncs::is_complete(Auth::user()->complete_percent,3))
                <img src="/site/default/Template_2019/img/success.svg" />
                @else
                <img src="/site/default/Template_2019/img/pending.svg" />
                @endif
                    <span class="mr-2 font-14">آموزش ها و مهارت ها</span>                
                </a>
            </div>

            <div class="wizard-process-item">
                <a  href="{{route('user.resume.5')}}">
                @if(\HR\myFuncs::is_complete(Auth::user()->complete_percent,5))
                <img src="/site/default/Template_2019/img/success.svg" />
                @else
                <img src="/site/default/Template_2019/img/pending.svg" />
                @endif
                <span class="mr-2 font-14">پرسشنامه تکمیلی</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicSupportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">پشتیبانی</h5>

            </div>
            <div class="modal-body">
                 <div class="col-md-12">
                  

                <div class="people-forms-fields-group">
                    <select onchange="select_box(this)" data-validation="required" name="ticket_type" id="ticket_type" data-placeholder="یک گزینه انتخاب کنید"
                             class="people-forms-fields input__field input__field--minoru form-control">
                        <option disabled selected>نوع تیکت</option>

                        <option value="technical_problem_box">مشکل فنی در تکمیل فرم استخدامی </option>
                        <option value="review_user_resume_box">مشکل در برقراری ارتباط با شرکت ها</option>
                        <option value="defect_information_box">افزودن اطلاعات تحصیلی به سامانه</option>
                        <option value="suggestions_box">ارائه پیشنهاد و انتقاد </option>

                    </select>
                </div>
                </div>

            <!--    <div>
                    <div class="people-forms-fields-group has-success">
                        <label style="color:red">کاربر گرامی پاسخ تیکت شما به ایمیل درج شده ارسال خواهد شد.</label>
                        <input type="text" name="email" id="email" class="title form-control" placeholder="ایمیل">

                    </div>
                </div>-->
                
          

                <div id="technical_problem_box" class="support_hide">
                    <div class="people-forms-fields-group card-body">
                        <textarea data-validation="required" name="tec_problem_detail" id="tec_problem_detail" class="form-control textarea-rtl faq-txt" placeholder="توضیحات"></textarea>
                    </div>
                </div>
                
                <div id="review_user_resume_box" class="col-md-12 people-forms-fields-group support_hide">

                    <select data-validation="required" name="company_name" id="company_name" placeholder="یک گزینه انتخاب کنید"
                            class="form-control people-forms-fields po-input-select">
                        <option disabled selected>نام شرکت</option>
                        @foreach($filter_companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach

                    </select>

                    <div class="people-forms-fields-group card-body">
                        <textarea name="resume_more_details" id="resume_more_details" class="form-control textarea-rtl faq-txt" placeholder="توضیحات"></textarea>
                    </div>
                </div>

                <div id="suggestions_box" class="col-md-12  people-forms-fields-group support_hide">
                    <div class="card-body">
                        <textarea name="suggestion_more_details" id="suggestion_more_details" class="form-control textarea-rtl faq-txt" placeholder="پیشنهادات و انتقادات"></textarea>
                    </div>
                </div>

                <div id="defect_information_box" class="col-md-12 people-forms-fields-group support_hide">
                    <div class="card-body">
                        <textarea name="defect_details" id="defect_details" class="form-control textarea-rtl faq-txt" placeholder="توضیحات"></textarea>
                    </div>
                </div>
                
                  <div class="col-md-12">
               
                  <div class="people-forms-fields-group  has-success">
                     <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>

                        <input class="people-forms-fields input__field input__field--minoru form-control" autocomplete="off" type="text"  name="email" id="email"/>
                      <label> ایمیل</label>

                        <span style="color:red">کاربر گرامی پاسخ تیکت شما به ایمیل درج شده ارسال خواهد شد.</span>
                    </div>
              
                <br/>

                </div> 

                <div class="col-md-12">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                        <input class="people-forms-fields input__field input__field--minoru form-control" autocomplete="off" name="captcha" type="text" id="captcha"/>
                        <label> تصویر امنیتی را تایپ کنید</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="people-forms-fields-group text-right">
                        <img class="captcha_login" id="captcha_login_1" src="{{route('site.captcha','support_ticket_captcha')}}<?php echo '?ver='.time()?>">
                        <img id="refresh-captcha" src="/site/default/Template_2019/img/refresh.svg" onclick="$('#captcha_login_1').attr('src', '{{route('site.captcha','support_ticket_captcha')}}?ver='+(new Date()).getTime());" style="cursor: pointer">
                    </div>
                </div>  
                



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-primary store_ticket" >ارسال تیکت</button>
            </div>
        </div>
    </div>
</div>

<script>
    function select_box(selectObject) {

        var value = selectObject.value;
       $('#'+value).siblings('.support_hide').hide();
       $('#'+value).show();
        //console.log(value);

    }
    
    



</script>