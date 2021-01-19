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

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
        }
        img.company-logo {
    width: 40px;
}
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: پروفایل
@endsection

@section('content')
        <div>
            <div class="col-xs-12 wrap-content">
                @include('site.pages.user.side_bar')
                <div class="container mt-5" id="scroll-resume">
                    @if (count($errors) > 0)
                        <div class="bg-error" style="text-align: right">
                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                            @foreach ($errors->all() as $error)
                                <p style="direction: rtl">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('flash_message'))
                        <div class="bg-error" style="text-align: right">
                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                            <p style="direction: rtl">{!! session('flash_message') !!}</p>
                        </div>
                    @endif
                    <table class="table table-striped table-hover font-13">
                        <thead>
                        <tr>
                            <th>شرکت</th>
                            <th>عنوان شغل</th>
                            <th>وضعیت شغل</th>
                            <th>وضعیت درخواست</th>
                            <th>پیام</th>
                            <th>تاریخ درخواست</th>
                            <th>انصراف از درخواست</th>
                            {{--<th>پیام به شرکت</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $app_status = config('app.enum_apply_status');
                        $app_color=[
                            0 => 'blue',
                            1 => 'orange',
                            4 => 'orange',
                            2 => 'green',
                            3 => 'red',
                            5 => 'orange',
                            6 => 'orange',
                            7 => 'orange',
                            8 => 'orange',
                        ];
                        @endphp
                        @foreach($applies_ids as $id)

                                <tr>
                                    <td><a><img src="{{$result[$id]->job->company->get_gig_data()['logo']}}"
                                                title="{{$result[$id]->job->company->name}}" class="company-logo"></a>
                                    </td>
                                    <td>
                                        <a href="{{route('jobs.show',$result[$id]->job->persian_alias)}}">{{$result[$id]->job->title}}</a>
                                    </td>
                                    @if($result[$id]->job->status == 3)
                                        <td class="red">آگهی بسته شد</td>
                                    @elseif($result[$id]->job->is_expired())
                                        <td class="red">آگهی منقضی شد</td>
                                    @else
                                        <td class="green">فعال</td>
                                    @endif
                                    <td class="{{$app_color[$result[$id]->status]}}">
                                        @if($result[$id]->status == 4)برگزیده جهت ارزیابی 
                                        @elseif($result[$id]->status == 2)استخدام شده
                                        @else{{$app_status[$result[$id]->status]}}</td>
                                        @endif

                                    @if($result[$id]->ticket_reply_from_admin())
                                        <td>
                                            <a href="{{ route('site.tickets.show',$result[$id]->ticket_reply_from_admin()) }}"
                                               data-toggle="tooltip" title="" data-original-title="پیام از ادمین">
                                                <img src="/site/default/img/hr_comment-1.png"></a></td>
                                    @else
                                        <td><a><img title="پیامی از طرف ادمین برای شما ارسال نشده است"
                                                    src="/site/default/img/hr_comment-2.png"></a></td>
                                    @endif
                                    <td>{{JDate::createFromCarbon(Carbon::parse($result[$id]->created_at))->format('l j F Y')}}</td>
                                    <td style="text-align: center">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['applies.destroy', $result[$id]->id] ]) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'submit','class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    {{-- <td style="text-align: center">
                                         {!! Form::open(['method' => 'POST', 'route' => ['user.messages.compose', $result[$id]->job->company->users->first()->id,'apply',$result[$id]->id] ]) !!}
                                         {!! Form::button('<i class="fa fa-envelope"></i>', ['type'=>'submit','class' => 'btn btn-sm btn-warning']) !!}
                                         {!! Form::close() !!}

                                     </td>
                                     --}}
                                </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection







@section('script')
    <script>
        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top - 20
                }, 'slow');
            });
        }
    </script>
@endsection