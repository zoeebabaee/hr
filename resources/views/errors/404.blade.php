<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/site/default/css/bootstrap.css">
    <link rel="stylesheet" href="/site/default/css/fontiran.css">
    <style>
        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #555;
            font-size: 1.4em;
            font-weight: 400;
            margin: 1.5em 0;
            line-height: 1.5em;
            direction: rtl;
        }

        p {
            margin: 0 auto;
            width: 280px;
            font-size: 1.3em;
        }

        a {
            color: #ff9934;
            text-decoration: none;
            margin-bottom: 1em;
            display: inline-block;
            direction: rtl;
            font-size: 1.3em;
            font-weight: 500
        }

        a:hover {
            text-decoration: none;
            color: #333;
        }

        .form-search {
            margin-bottom: 2em;
        }

        .form-input-search {
            direction: rtl;
        }

        @media only screen and (max-width: 280px) {
            body,
            p {
                width: 95%;
            }
            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }
        }
        .btn-more {
            padding: 0px 25px 0px 30px;
            color: #fff;
            font-weight: 500;
            background: #ff8c3f;
            font-size: 14px;
            transition: all 0.7s ease 0s;
            border: none;
            -webkit-border-top-left-radius: 30px;
            -webkit-border-bottom-left-radius: 30px;
            -moz-border-radius-topleft: 30px;
            -moz-border-radius-bottomleft: 30px;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            height: 34px;
            line-height: 30px;
            position: relative;
            z-index: 9;
            right:-2px
        }
        .btn-more:hover , .btn-more:focus {
            transition: all 0.7s ease 0s;
            color: #fff;

        }
        .form-input-search{
            border:2px solid #ff9934 !important;

        }
    </style>
</head>
<body>
<img src="/site/default/img/404.png" title="404" alt="404">
<h1>
    با عرض پوزش از شما کاربر گرامی؛<br/>
    صفحه مورد نظر یافت نشد.
</h1>
<div class="container form-search">
    <div class="col-lg-4 col-lg-pull-4 col-md-4 col-md-pull-4 col-sm-6 col-sm-pull-3">
        <form action="{{route('site.search')}}" method="GET">
        <div class="input-group">
                <span class="input-group-btn">
                <button class="btn  btn-more" type="submit">جستجو</button>
                </span>

            <input class="form-control form-input-search" name="query" placeholder="جستجو کنید..." type="text">

        </div>
        </form>
    </div>
</div>
<a href="{{route('home')}}">برای بازگشت به صفحه اصلی کلیک نمائید.</a>
<p>با تشکر</p>
</body>
</html>
