
<div class="row bs-wizard" style="border-bottom:1px dashed #ddd;margin-bottom:30px;padding-bottom:52px">
    <div class="bs-wizard-step @if(HR\myFuncs::percent_state(Auth::user()->complete_percent)[0]) {{'complete'}}  @elseif( Request::route()->getName() == 'user.resume.1') {{'active'}} @else {{'disabled'}} @endif">
        <div class="text-center bs-wizard-stepnum hidden-xs"><a href="{{route('user.resume.1')}}">مشخصات شغل</a></div>
        <div class="text-center bs-wizard-stepnum visible-xs"><a href="{{route('user.resume.1')}}">مرحله اول</a></div>
        <div class="progress"><div class="progress-bar"></div></div>
        <a href="{{route('user.resume.1')}}" class="bs-wizard-dot @if(Request::route()->getName() == 'user.resume.1' && !myFuncs::percent_state(Auth::user()->complete_percent)[0]) {{'bs-wizard-notcomplete'}} @endif "><i class="fa fa-check"></i></a>
    </div>

    <div class="bs-wizard-step @if(HR\myFuncs::percent_state(Auth::user()->complete_percent)[1] ) {{'complete'}} @elseif( Request::route()->getName() == 'user.resume.2') {{'active'}} @else {{'disabled'}} @endif">
        <div class="text-center bs-wizard-stepnum hidden-xs"><a href="{{route('user.resume.2')}}">تحصیلات</a></div>
        <div class="text-center bs-wizard-stepnum visible-xs"><a href="{{route('user.resume.2')}}">مرحله دوم</a></div>
        <div class="progress"><div class="progress-bar"></div></div>
        <a href="{{route('user.resume.2')}}" class="bs-wizard-dot @if(Request::route()->getName() == 'user.resume.2' && !myFuncs::percent_state(Auth::user()->complete_percent)[1])) {{'bs-wizard-notcomplete'}} @endif "><i class="fa fa-check"></i></a>
    </div>

    <div class="bs-wizard-step @if(HR\myFuncs::percent_state(Auth::user()->complete_percent)[2]) {{'complete'}}  @elseif( Request::route()->getName() == 'user.resume.3') {{'active'}} @else {{'disabled'}} @endif">
        <div class="text-center bs-wizard-stepnum hidden-xs"><a href="{{route('user.resume.3')}}">آموزشها و مهارتها </a></div>
        <div class="text-center bs-wizard-stepnum visible-xs"><a href="{{route('user.resume.3')}}">مرحله سوم</a></div>
        <div class="progress"><div class="progress-bar"><a href="{{route('user.resume.3')}}"></div></div>
        <a href="{{route('user.resume.3')}}" class="bs-wizard-dot @if(Request::route()->getName() == 'user.resume.3' && !myFuncs::percent_state(Auth::user()->complete_percent)[2])) {{'bs-wizard-notcomplete'}} @endif " ><i class="fa fa-check"></i></a>
    </div>

    <div class="bs-wizard-step @if(HR\myFuncs::percent_state(Auth::user()->complete_percent)[3]) {{'complete'}}  @elseif( Request::route()->getName() == 'user.resume.4') {{'active'}} @else {{'disabled'}} @endif">
        <div class="text-center bs-wizard-stepnum hidden-xs"><a href="{{route('user.resume.4')}}">سوابق شغلی</a></div>
        <div class="text-center bs-wizard-stepnum visible-xs"><a href="{{route('user.resume.4')}}">مرحله چهارم</a></div>
        <div class="progress"><div class="progress-bar"></div></div>
        <a href="{{route('user.resume.4')}}" class="bs-wizard-dot @if(Request::route()->getName() == 'user.resume.4' && !myFuncs::percent_state(Auth::user()->complete_percent)[3])) {{'bs-wizard-notcomplete'}} @endif " ><i class="fa fa-check"></i></a>
    </div>


</div>