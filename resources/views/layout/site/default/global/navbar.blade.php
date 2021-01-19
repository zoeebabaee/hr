<div class="cd-overlay"></div>

<!--model register-->
<div  class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
            <h2 ><img src="/site/default/img/profile_login.png" title="" alt="" width="50"><span > ورود</span></h2>
            <br>
            <span id="login_messages"></span>
            <br>
            <form action="javascript:void(0);" method="POST" id="login_ajax_modal" onsubmit="return sendLoginAjax();">
                {{csrf_field()}}
                <input type="text" name="mobile" id=mobile"" placeholder="شماره موبایل" class="form-control">
                <input type="password" id="password" name="password" placeholder="رمز عبور" class="form-control">

                <div class="captcha" align="middle">
                    <img id="captcha_login" src="{{route('site.captcha','login_modal')}}">
                    <img id="refresh-captcha" src="/site/default/img/refresh.png" onclick="$('#captcha_login').attr('src', '{{route('site.captcha','login_modal')}}?ver='+(new Date()).getTime());" style="cursor: pointer">
                </div>
                <input type="text" id="login_captcha" name="login_captcha" autocomplete="off" placeholder="متن تصویر امنیتی را تایپ کنید" class="form-control">
                <label for="checkboxes-0" class="rememberme">
                  <input name="remember" id="checkboxes-0" value="1" type="checkbox">
                   مرا به خاطر بسپار
                </label>
                <input  type="submit" name="login"  class="btn login loginmodal-submit" value="ورود">

            </form>
            <div class="login-help">
                <a target="_blank" href="{{route('register')}}"> عضویت </a>  |  <a target="_blank" href="{{route('user.forget.password')}}"> فراموشی رمز عبور </a>
            </div>
        </div>
    </div>
</div>

<script>
    function sendLoginAjax(){var uu=$('#mobile').val();var pp=$('#password').val();var cc=$('#login_captcha').val();if(uu==""||pp==""){$('#login_messages').html('<p style="text-align:center;padding:4px;color:red;">شماره موبایل یا رمز عبور خالی است</p>');return!1}
        if(cc==""){$('#login_messages').html('<p style="text-align:center;padding:4px;color:red;">کد امنیتی را وارد نکرده اید</p>');return!1}
        $('#login_messages').html('<p style="text-align:center;padding:4px;color:cadetblue;">در حال بررسی</p>');$.ajax({type:"POST",url:"{{route('login.store.modal')}}",data:$('#login_ajax_modal').serialize(),success:function(data){if(data=="ok"){$('#login_messages').html('<p style="text-align:center;padding:4px;color:green;">خوش آمدید...در حال ورود</p>');location.reload();return!0}else{$('#login_messages').html('<p style="text-align:center;padding:4px;color:red;">'+data+'</p>');$('#captcha_login').attr('src','https://people.golrang.com/site/captcha/login_modal?ver='+(new Date()).getTime());return!0}},dataType:'text'})}
</script>