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
    #timer {
    border: 1px solid #d0d0d0;
    border-radius: 50px;
    width: 80px;
    height: 80px;
    margin: 0 auto;
    line-height: 80px;
    font-size: 30px;
    font-weight: 200;
    margin-top: 30px;
}
</style>
<script type="text/javascript">
  var count = 10;
  var redirect = "/jobs";

  function countDown() {
    var timer = document.getElementById("timer"); 
    if (count > 0) {
      count--;
      timer.innerHTML = "" + count + " ";
      setTimeout("countDown()", 1000);
    } else {
      window.location.href = redirect;
    }
  }
</script>
@endsection
@section('title')
سامانه منابع انسانی :: پروفایل
@endsection
@section('content')
@include('site.pages.user.side_bar')
            
            
<div class="container text-center mt-7">
    <img class="mb-3" src="/site/default/Template_2019/img/finall_checked.svg" />
    <div class="text-success mt-2 mb-3">شما تمام موارد را با موفقیت برای ما ارسال کرده اید</div>
    <div class="text-secondary">تا چند ثانیه دیگر به صفحه ی "  <span class="text-danger"> فرصت های شغلی </span> " منتقل خواهید شد</div>
      <div id="timer">
        <script type="text/javascript">
          countDown();
        </script>
      </div>
</div>
            


@endsection