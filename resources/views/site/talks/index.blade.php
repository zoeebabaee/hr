@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    گفتگوها
@endsection

@section('header_styles')
    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
@endsection
@section('content')

    {{--<div class="col-xs-12 wrapper border-bottom white-bg page-heading">--}}
    {{--<div class="col-lg-10">--}}
    {{--<h2>--}}
    {{--نمایش گفتگو</h2>--}}
    {{--<ol class="breadcrumb">--}}
    {{--<li>--}}
    {{--<a href="index-2.html">--}}
    {{--خانه</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a>--}}
    {{--متفرقه</a>--}}
    {{--</li>--}}
    {{--<li class="active">--}}
    {{--<strong>--}}
    {{--نمایش گفتگو</strong>--}}
    {{--</li>--}}
    {{--</ol>--}}
    {{--</div>--}}
    {{--<div class="col-lg-2">--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins" style="margin: 0px; text-align: center;color: #26ae60;">
                    <div class="ibox-content" id="header-message"><i class="fa fa-lock"></i>
                        <strong>اتاق گفتگو،</strong>
                        محلی برای گفتگو بین مدیران سامانه منابع انسانی به صورت امن و رمزنگاری شده
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox chat-view">
                    <div class="ibox-title">
                        <small class="pull-right text-muted"><i class="fa fa-comments"></i> {{$chat_with}}</small>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-9 ">
                                <div class="chat-discussion" id="chats-div">
                                    @foreach($talks as $talk)
                                        <div class="chat-message @if(Auth::user()->id == $talk->from)left @else right @endif"
                                             id="{{$talk->id}}">
                                            <img class="message-avatar" src="{{$talk->sender->avatar}}" alt="">
                                            <div class="message">
                                                <a class="message-author">{{$talk->sender->first_name.' '.$talk->sender->last_name}} </a>
                                                <span class="message-date">{{JDate::createFromCarbon(Carbon::parse($talk->created_at))->format('l j F , H:i')}}</span>
                                                <span class="message-content">{!! str_replace("\n", "<br>", $talk->msg) !!}</span>
                                                @if($talk->from == Auth::user()->id)
                                                    <span class="pull-left" style="margin-top: -13px;"
                                                          id="seen-status-{{$talk->id}}">
                                                        @if($talk->seen)
                                                            <i class="fa fa-check"
                                                               style="font-size: 10px;margin-left: -10px;"></i>
                                                        @endif
                                                        <i class="fa fa-check" style="font-size: 10px;"></i>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($talks->count()==0)
                                        <span style="display: block;text-align: center;margin: 15% 0px; color: #74b9ff;">هیچ پیامی نیست!</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="chat-users">
                                    <div class="users-list">

                                        <div class="chat-user"
                                             @if($id == null) style="background-color: #eee; border-left:4px solid #74b9ff;" @endif >
                                            <img class="chat-avatar"
                                                 style="width: 32px;height: 32px;border-radius: 30px;"
                                                 src="data:image/jpeg;base64,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"
                                                 alt="">
                                            <div class="chat-user-name">
                                                <a href="{{route('talks')}}">گفتگو عمومی</a>
                                                <span id="unread-messages-from-public"
                                                      class="pull-left label label-primary"
                                                      data-sort="9999999999"
                                                      style="border-radius: 30px;width: 20px;height: 20px;text-align: center;vertical-align: middle;padding: 5px 0px;margin: 0;display: none;"></span>
                                            </div>
                                        </div>
                                        @foreach($top_users as $user)
                                            @if($user->id == Auth::user()->id)
                                                @continue
                                            @endif
                                            <div class="chat-user"
                                                 @if($id == $user->id) style="display: none;background-color: #eee; border-left:4px solid #74b9ff;"
                                                 @else  style="display: none"@endif >
                                                <img class="chat-avatar"
                                                     style="width: 32px;height: 32px;border-radius: 30px;"
                                                     src="{{$user->avatar}}" alt="">
                                                <div class="chat-user-name">
                                                    <a href="{{route('talks',$user->id)}}">{{$user->first_name.' '.$user->last_name}}</a>
                                                    @if($user->hasRole('برنامه نویس'))
                                                        <p>برنامه نویس</p>
                                                    @else
                                                        <p>{{$user->company()->first()->name}}</p>
                                                    @endif


                                                    @if(isset($unread_messages_list[$user->id]) && $unread_messages_list[$user->id] > 0)
                                                        <span id="unread-messages-from-{{$user->id}}"
                                                              class="pull-left label label-primary unread"
                                                              data-sort="{{10000000-$user->id}}"
                                                              style="border-radius: 30px;width: 20px;height: 20px;text-align: center;vertical-align: middle;padding: 5px 0px;margin: 0;">{{$unread_messages_list[$user->id]}}</span>
                                                    @else
                                                        <span id="unread-messages-from-{{$user->id}}"
                                                              class="pull-left label label-primary unread"
                                                              data-sort="{{10000000-$user->id}}"
                                                              style="border-radius: 30px;width: 20px;height: 20px;text-align: center;vertical-align: middle;padding: 5px 0px;margin: 0;display: none;"></span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($another_users as $user)
                                            @if($user->id == Auth::user()->id)
                                                @continue
                                            @endif
                                            <div class="chat-user"
                                                 @if($id == $user->id) style="display: none;background-color: #eee; border-left:4px solid #74b9ff;"
                                                 @else  style="display: none"@endif >
                                                <img class="chat-avatar"
                                                     style="width: 32px;height: 32px;border-radius: 30px;"
                                                     src="{{$user->avatar}}" alt="">
                                                <div class="chat-user-name">
                                                    <a href="{{route('talks',$user->id)}}">{{$user->first_name.' '.$user->last_name}}</a>
                                                    <p>{{$user->company()->first()->name}}</p>
                                                    <span id="unread-messages-from-{{$user->id}}"
                                                          class="pull-left label label-primary unread"
                                                          data-sort="{{10000000-$user->id}}"
                                                          style="border-radius: 30px;width: 20px;height: 20px;text-align: center;vertical-align: middle;padding: 5px 0px;margin: 0;display: none;"></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="chat-message-form">
                                    <div class="form-group">
                                        <textarea required class="form-control message-input" name="message"
                                                  id="message"
                                                  placeholder="نوشتن متن پیام"></textarea>
                                        <input style="width: 100%" id="send-msg" class="btn btn-success" type="submit"
                                               value="ارسال"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts_footer')
    <!-- Mainly scripts -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/jquery-2.1.1.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/bootstrap.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/metisMenu/jquery.metisMenu.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/slimscroll/jquery.slimscroll.min.js') }}
    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/pace/pace.min.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}

    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/datapicker/bootstrap-datepicker.js') }}



@endsection
@section('scripts_page')

    <script>
        var enable_sync = 1;
        var last_msg_id = {!! intval($talks->last()->id) !!};
        $(document).ready(function () {
            @if($talks->count())
            $('.chat-discussion').animate({
                scrollTop: $("#{!! $talks->last()->id !!}").offset().top
            })
            @endif
            window.setInterval(function () {
                sync_chat();
            }, 1000);
        });

        $('#send-msg').on('click', function () {
            send();
        });

        function sync_chat() {
            if (enable_sync != 1)
                return;

            enable_sync = 0;
            $.get("/adpanel/talks-refresh/" + last_msg_id + "{!! is_null($id)?'':'/'.$id !!}" + "?chat_session={!! $chat_session !!}", function (data) {

                if (data == 'invalid_chat_session') {
                    $('.chat-discussion').css('filter', 'blur(5px)');
                    $('#header-message').html(
                        "<strong style='color:red !important;'><i class='fa fa-times'></i> این صفحه در پنجره‌ای دیگر باز شده است!</strong>"
                    );
                    enable_sync = 0;
                    return;
                }

                for (i = 0; i < data['messages'].length; i++) {
                    var message_body = '<div class="chat-message ' + data['messages'][i].dir + '" id="' + data['messages'][i].id + '">\n' +
                        '                                            <img class="message-avatar" src="' + data['messages'][i].avatar + '" alt="">\n' +
                        '                                            <div class="message">\n' +
                        '                                                <a class="message-author">\n' +
                        '                                                    ' + data['messages'][i].name + '</a>\n' +
                        '                                                <span class="message-date">' + data['messages'][i].date + '</span>\n' +
                        '                                                <span class="message-content">' + data['messages'][i].msg + '</span>\n';
                    if (data['messages'][i].dir == 'left')
                        message_body = message_body +
                            '                                                <span class="pull-left" style="margin-top: -13px;"\n' +
                            '                                                          id="seen-status-' + data['messages'][i].id + '">' +
                            '                                                <i class="fa fa-check" style="font-size: 10px;"></i>\n' +
                            '                                                    </span>' +
                            '                                            </div>\n' +
                            '                                        </div>';
                    else
                        message_body = message_body +
                            '                                            </div>\n' +
                            '                                        </div>';
                    $('.chat-discussion').append(
                        message_body
                    );
                    last_msg_id = data['messages'][i].id;
                    $("#chats-div").animate({scrollTop: $('#chats-div').prop("scrollHeight")});
                }
                $.each(data['seen_status'], function (index, value) {
                    if (value == 1)
                        $('#seen-status-' + index).html(
                            '<i class="fa fa-check" style="font-size: 10px;margin-left: -10px;"></i>\n' +
                            '                                                        \n' +
                            '<i class="fa fa-check" style="font-size: 10px;"></i>'
                        );
                });


                var users_list = $('.unread');
                for (i = 0; i < users_list.length; i++) {
                    if (data['unread_messages_created_at'][(users_list[i].id).substr(21)]) {
                        $('#' + users_list[i].id).attr('data-sort', data['unread_messages_created_at'][(users_list[i].id).substr(21)]);
                    }
                    if (data['unread_messages'][(users_list[i].id).substr(21)]) {

                        $('#' + users_list[i].id).html(data['unread_messages'][(users_list[i].id).substr(21)]);
                        $('#' + users_list[i].id).show();
                    } else {
                        $('#' + users_list[i].id).html('');
                        $('#' + users_list[i].id).hide();
                    }
                }
                $('div.users-list').html(
                    $('div.chat-user').sort(function (a, b) {
                        var contentA = parseInt($(a).find("span").attr('data-sort'));
                        var contentB = parseInt($(b).find("span").attr('data-sort'));
                        return contentB-contentA;
                    })
                );
                $('.chat-user').show();
            });
            enable_sync = 1;
        }

        function send() {
            var message = $('#message').val();
            $('#message').val('');
            if (message.trim() == '')
                return false;

            var id = "{!! $id !!}";

            $.post(
                "{!! route('talks.store', $id) !!}",
                {
                    _token: "{!! csrf_token() !!}",
                    message: message
                }
            ).done(function () {
                $("#chats-div").animate({scrollTop: $('#chats-div').prop("scrollHeight")});
            });
        }

        $('#message').bind("enterKey", function (e) {
            enable_sync = 0;
            send();
            enable_sync = 1;
        });

        $('#message').keyup(function (e) {
            if (e.keyCode == 13 && !e.shiftKey) {
                $(this).trigger("enterKey");
            }
        });

    </script>

@endsection
