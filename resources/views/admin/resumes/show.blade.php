<?php
 header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="resume.pdf"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> PDF | سامانه منابع انسانی</title>
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="https://people.golrang.com/site/default/img/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://people.golrang.com/site/default/css/fontiran.css">
    
    

    <style>
        /* ==========================================================================
       Browser Upgrade Prompt
       ========================================================================== */

        .browserupgrade {
            margin: 0.2em 0;
            background: #ccc;
            color: #000;
            padding: 0.2em 0;
        }
        /* ==========================================================================
       Author's custom styles
       ========================================================================== */

        ::-moz-selection {
            background: #ddd;
            text-shadow: none;
            color: #111;
        }
        ::selection {
            background: #ddd;
            text-shadow: none;
            color: #111;
        }
        body {
            font-family: IRANSans;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
            margin: 0px;
        }
        a:hover,
        a:focus {
            text-decoration: none;
        }
        /* ==========================================================================
       Media Query
       ========================================================================== */
        /* Create MS (min-width: 480px) and (max-width: 767px) */

        .col-ms-1,
        .col-ms-2,
        .col-ms-3,
        .col-ms-4,
        .col-ms-5,
        .col-ms-6,
        .col-ms-7,
        .col-ms-8,
        .col-ms-9,
        .col-ms-10,
        .col-ms-11,
        .col-ms-12 {
            position: relative;
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
        }
        @media (min-width: 480px) and (max-width: 767px) {
            .col-ms-1,
            .col-ms-2,
            .col-ms-3,
            .col-ms-4,
            .col-ms-5,
            .col-ms-6,
            .col-ms-7,
            .col-ms-8,
            .col-ms-9,
            .col-ms-10,
            .col-ms-11,
            .col-ms-12 {
                float: right;
            }
            .col-ms-12 {
                width: 100%;
            }
            .col-ms-11 {
                width: 91.66666667%;
            }
            .col-ms-10 {
                width: 83.33333333%;
            }
            .col-ms-9 {
                width: 75%;
            }
            .col-ms-8 {
                width: 66.66666667%;
            }
            .col-ms-7 {
                width: 58.33333333%;
            }
            .col-ms-6 {
                width: 50%;
            }
            .col-ms-5 {
                width: 41.66666667%;
            }
            .col-ms-4 {
                width: 33.33333333%;
            }
            .col-ms-3 {
                width: 25%;
            }
            .col-ms-2 {
                width: 16.66666667%;
            }
            .col-ms-1 {
                width: 8.33333333%;
            }
            .col-ms-pull-12 {
                right: 100%;
            }
            .col-ms-pull-11 {
                right: 91.66666667%;
            }
            .col-ms-pull-10 {
                right: 83.33333333%;
            }
            .col-ms-pull-9 {
                right: 75%;
            }
            .col-ms-pull-8 {
                right: 66.66666667%;
            }
            .col-ms-pull-7 {
                right: 58.33333333%;
            }
            .col-ms-pull-6 {
                right: 50%;
            }
            .col-ms-pull-5 {
                right: 41.66666667%;
            }
            .col-ms-pull-4 {
                right: 33.33333333%;
            }
            .col-ms-pull-3 {
                right: 25%;
            }
            .col-ms-pull-2 {
                right: 16.66666667%;
            }
            .col-ms-pull-1 {
                right: 8.33333333%;
            }
            .col-ms-pull-0 {
                right: auto;
            }
            .col-ms-push-12 {
                left: 100%;
            }
            .col-ms-push-11 {
                left: 91.66666667%;
            }
            .col-ms-push-10 {
                left: 83.33333333%;
            }
            .col-ms-push-9 {
                left: 75%;
            }
            .col-ms-push-8 {
                left: 66.66666667%;
            }
            .col-ms-push-7 {
                left: 58.33333333%;
            }
            .col-ms-push-6 {
                left: 50%;
            }
            .col-ms-push-5 {
                left: 41.66666667%;
            }
            .col-ms-push-4 {
                left: 33.33333333%;
            }
            .col-ms-push-3 {
                left: 25%;
            }
            .col-ms-push-2 {
                left: 16.66666667%;
            }
            .col-ms-push-1 {
                left: 8.33333333%;
            }
            .col-ms-push-0 {
                left: auto;
            }
            .col-ms-offset-12 {
                margin-left: 100%;
            }
            .col-ms-offset-11 {
                margin-left: 91.66666667%;
            }
            .col-ms-offset-10 {
                margin-left: 83.33333333%;
            }
            .col-ms-offset-9 {
                margin-left: 75%;
            }
            .col-ms-offset-8 {
                margin-left: 66.66666667%;
            }
            .col-ms-offset-7 {
                margin-left: 58.33333333%;
            }
            .col-ms-offset-6 {
                margin-left: 50%;
            }
            .col-ms-offset-5 {
                margin-left: 41.66666667%;
            }
            .col-ms-offset-4 {
                margin-left: 33.33333333%;
            }
            .col-ms-offset-3 {
                margin-left: 25%;
            }
            .col-ms-offset-2 {
                margin-left: 16.66666667%;
            }
            .col-ms-offset-1 {
                margin-left: 8.33333333%;
            }
            .col-ms-offset-0 {
                margin-left: 0%;
            }
        }
        .visible-ms {
            display: none !important;
        }
        .visible-ms-block,
        .visible-ms-inline,
        .visible-ms-inline-block {
            display: none !important;
        }
        @media (min-width: 480px) and (max-width: 767px) {
            .visible-ms {
                display: block !important;
            }
            table.visible-ms {
                display: table !important;
            }
            tr.visible-ms {
                display: table-row !important;
            }
            th.visible-ms,
            td.visible-ms {
                display: table-cell !important;
            }
        }
        @media (min-width: 480px) and (max-width: 767px) {
            .visible-ms-block {
                display: block !important;
            }
        }
        @media (min-width: 480px) and (max-width: 767px) {
            .visible-ms-inline {
                display: inline !important;
            }
        }
        @media (min-width: 480px) and (max-width: 767px) {
            .visible-ms-inline-block {
                display: inline-block !important;
            }
        }
        @media (min-width: 480px) and (max-width: 767px) {
            .hidden-ms {
                display: none !important;
            }
        }
        .cd-main-header {
            height: 80px;
            z-index: 10;
        }
        @media (min-width: 1170px) {
            .cd-inner-content {
                background: #f5f7fa;
            }
        }



        @media (min-width: 1170px) {

            .center-div {
                align-items: center;
                display: flex;
                flex-direction: row;
                justify-content: center;
            }
        }




        @media (min-width: 1650px) {
            .wrap-pdf-inner p {
                width: 25%;
                float: right
            }
            .t-menu {
                border-bottom: 1px solid #e2e3df !important;
                margin-left: 50px !important;
            }

            .c-right-b {
                border-right: 1px solid #ddd;
                margin: 0px 0px 30px 0px;
                min-height: 500px;
            }
            .half-width ul li {
                width: 33% !important;
                float: right;
                padding: 0px 30px;
            }
            .wrap-horizontal-blog {
                height: 186px;
            }
            .wrap-vertical-blog {
                height: 388px;
            }
            .jobs-carousel .owl-nav .owl-prev {
                left: -25px !important;
            }
            .jobs-carousel .owl-nav .owl-next {
                right: -25px !important;
            }
            .part {
                padding: 0px 50px;
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd {
                padding: 0px !important;
            }
            .no-padd-r {
                padding-right: 0px !important;
            }
            .no-padd-l {
                padding-left: 0px !important;
            }
            #section3 .pp-tableCell {
                margin-top: 80px
            }
        }
        @media only screen and (min-width: 1200px) and (max-width: 1650px) {
            .t-menu {
                border-bottom: 1px solid #e2e3df !important;
                margin-left: 50px !important;
            }
            .wrap-pdf-inner p {
                width: 25%;
                float: right
            }
            .c-right-b {
                border-right: 1px solid #ddd;
                margin: 0px 0px 30px 0px;
            }
            .half-width ul li {
                width: 33% !important;
                float: right;
                padding: 0px 30px;
            }
            .wrap-horizontal-blog {
                height: 186px;
            }
            .wrap-vertical-blog {
                height: 388px;
            }
            .jobs-carousel .owl-nav .owl-prev {
                left: -25px !important;
            }
            .jobs-carousel .owl-nav .owl-next {
                right: -25px !important;
            }
            .part {
                padding: 0px 50px;
            }
            #section3 .pp-tableCell {
                margin-top: 50px
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd {
                padding: 0px !important;
            }
            .no-padd-r {
                padding-right: 0px !important;
            }
            .no-padd-l {
                padding-left: 0px !important;
            }
        }
        @media only screen and (min-width: 992px) and (max-width: 1200px) {
            .wrap-pdf-inner p {
                width: 25%;
                float: right
            }
            .c-right-b {
                border-right: 1px solid #ddd;
                margin: 0 0 30px;
            }
            .half-width ul li {
                width: 33% !important;
                float: right;
                padding: 0px 30px;
            }
            .num-request h6 {
                font-size: 11px !important;
            }
            .wrap-horizontal-blog {
                height: 186px;
            }
            .wrap-vertical-blog {
                height: 388px;
            }
            .jobs-carousel .owl-nav .owl-prev {
                left: -25px !important;
            }
            .jobs-carousel .owl-nav .owl-next {
                right: -25px !important;
            }

            .cd-main-header {
                background: #fff;
            }
            .no-padd {
                padding: 0px !important;
            }
            .no-padd-r {
                padding-right: 0px !important;
            }
            .no-padd-l {
                padding-left: 0px !important;
            }
        }
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .wrap-pdf-inner p {
                width: 50%;
                float: right
            }
            .half-width ul li {
                width: 33% !important;
                float: right;
                padding: 0px 30px;
            }
            .wrap-horizontal-blog {
                height: 186px;
            }
            .jobs-carousel .owl-nav .owl-prev {
                left: -25px !important;
            }
            .jobs-carousel .owl-nav .owl-next {
                right: -25px !important;
            }
            .cd-primary-nav a,
            .cd-primary-nav ul a {
                padding: 0 40px !important;
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd-xs {
                padding: 0px !important;
            }
            .btn-search {
                right: 0px !important;
                margin-top: 10px;
            }
            .copy-right {
                position: relative !important;
                top: 30px !important;
            }
        }
        @media only screen and (min-width: 480px) and (max-width: 768px) {
            .fl-div .pull-left {
                width: 100%;
            }
            .wrap-pdf-inner p {
                width: 50%;
                float: right
            }
            .half-width ul li {
                width: 33% !important;
                float: right;
                padding: 0px 30px;
            }
            .fl-div p {
                width: 100% !important;
            }
            .row-news img {
                width: 100%;
                margin-bottom: 10px;
            }
            .wrap-horizontal-blog {
                height: 186px;
            }
            .copy-right {
                position: relative !important;
                top: 30px !important;
            }
            #pp-nav {
                display: none;
            }
            .cd-primary-nav a,
            .cd-primary-nav ul a {
                padding: 0 40px !important;
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd-xs {
                padding: 0px !important;
            }
            .btn-search {
                right: 0px !important;
                margin-top: 10px;
            }
        }
        @media only screen and (min-width: 360px) and (max-width: 480px) {
            .fl-div .pull-left {
                width: 100%;
            }
            .half-width ul li {
                width: 50% !important;
                float: right;
                padding: 0px 30px;
            }
            .fl-div p {
                width: 100% !important;
            }
            .row-news img {
                width: 100%;
                margin-bottom: 10px;
            }
            .fr-blog {
                margin-bottom: 20px;
                width: 100%;
            }
            .col1-part1 h2 {
                float: right;
                width: 100%;
                margin-top: 15px;
            }
            .col1-part1 a {
                float: right;
                width: 100%;
            }
            .copy-right {
                position: relative !important;
                top: 30px !important;
            }
            #pp-nav {
                display: none;
            }
            .cd-primary-nav a,
            .cd-primary-nav ul a {
                padding: 0 40px !important;
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd-xs {
                padding: 0px !important;
            }
            .btn-search {
                right: 0px !important;
                margin-top: 10px;
            }
            .wrapper-partners h4{
                width: 100%;
            }
            .title-partners h5{
                width: 100%;
            }
            .title-partners h6{
                width: 100%;
            }
        }
        @media only screen and (min-width: 320px) and (max-width: 360px) {
            .wrapper-partners h4{
                width: 100%;
            }
            .title-partners h5{
                width: 100%;
            }
            .title-partners h6{
                width: 100%;
            }
            .fl-div .pull-left {
                width: 100%;
            }
            .half-width ul li {
                width: 50% !important;
                float: right;
                padding: 0px 30px;
            }
            .fl-div p {
                width: 100% !important;
            }
            .row-news img {
                width: 100%;
                margin-bottom: 10px;
            }
            .fr-blog {
                margin-bottom: 20px;
                width: 100%;
            }
            .col1-part1 h2 {
                float: right;
                width: 100%;
                margin-top: 15px;
            }
            .copy-right {
                position: relative !important;
                top: 30px !important;
            }
            #pp-nav {
                display: none;
            }
            .cd-primary-nav a,
            .cd-primary-nav ul a {
                padding: 0 40px !important;
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd-xs {
                padding: 0px !important;
            }
            .btn-search {
                right: 0px !important;
                margin-top: 10px;
            }
        }
        @media only screen and (max-width: 320px) {
            .wrapper-partners h4{
                width: 100%;
            }
            .title-partners h5{
                width: 100%;
            }
            .title-partners h6{
                width: 100%;
            }
            .fl-div .pull-left {
                width: 100%;
            }
            .half-width ul li {
                width: 100% !important;
                float: right;
                padding: 0px 30px;
            }
            .fl-div p {
                width: 100% !important;
            }
            .row-news img {
                width: 100%;
                margin-bottom: 10px;
            }
            .fr-blog {
                margin-bottom: 20px;
                width: 100%;
            }
            .col1-part1 h2 {
                float: right;
                width: 100%;
                margin-top: 15px;
            }
            .copy-right {
                position: relative !important;
                top: 30px !important;
            }
            .cd-primary-nav a,
            .cd-primary-nav ul a {
                padding: 0 40px !important;
            }
            #pp-nav {
                display: none;
            }
            .cd-main-header {
                background: #fff;
            }
            .no-padd-xs {
                padding: 0px !important;
            }
            .btn-search {
                right: 0px !important;
                margin-top: 10px;
            }
        }
        /*mega menu*/

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: middle;
        }
        /* HTML5 display-role reset for older browsers */

        ol,
        ul {
            list-style: none;
        }
        html {
            font-size: 62.5%;
        }
        body {
            font-size: 1.6rem;
            font-family: sans-serif;
            color: #2e3233;
            background-color: #ffffff;
        }
        @media only screen and (max-width: 1169px) {
            body.nav-on-left.overflow-hidden {
                overflow: hidden;
            }
        }
        a {
            color: #333;
            text-decoration: none;
        }
        img {
            /* make images responsive */

            max-width: 100%;
        }
        input {
            font-family: sans-serif;
            font-size: 1.4rem;
        }
        input[type="search"]::-ms-clear {
            /* removes close icon - IE */

            display: none;
        }
        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }
        /* --------------------------------

    Main components

    -------------------------------- */

        .cd-main-header {
            /* Force Hardware Acceleration in WebKit */

            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            will-change: transform;
        }
        .cd-main-header {
            position: relative;
            -webkit-transition: -webkit-transform 0.3s;
            -moz-transition: -moz-transform 0.3s;
            transition: transform 0.3s;
        }
        @media only screen and (max-width: 1169px) {
            .cd-main-header.nav-is-visible {
                -webkit-transform: translateX(-260px);
                -moz-transform: translateX(-260px);
                -ms-transform: translateX(-260px);
                -o-transform: translateX(-260px);
                transform: translateX(-260px);
            }
            .nav-on-left .cd-main-header.nav-is-visible {
                -webkit-transform: translateX(260px);
                -moz-transform: translateX(260px);
                -ms-transform: translateX(260px);
                -o-transform: translateX(260px);
                transform: translateX(260px);
            }
        }
        .cd-main-content {
            min-height: 100vh;
            z-index: 2;
        }
        .nav-is-fixed .cd-main-header {
            /* add .nav-is-fixed class to body if you want a fixed navigation on > 1170px */

            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }
        @media only screen and (min-width: 1170px) {
            .cd-main-header {
                height: 80px;
                position: fixed;
                width: 100%;
            }
            .cd-main-header::after {
                clear: both;
                content: "";
                display: table;
            }
        }
        .cd-logo {
            position: absolute;
            top: 12px;
            right: 5%;
            z-index: 9;
        }
        .cd-logo img {
            display: block;
        }
        @media only screen and (max-width: 1169px) {
            .nav-on-left .cd-logo {
                right: auto;
                left: 5%;
            }
        }
        @media only screen and (min-width: 1170px) {
            .cd-logo {
                top: 15px;
                width: 128px;
            }
        }
        .cd-header-buttons {
            position: absolute;
            display: inline-block;
            top: 20px;
            left: 2%;
            z-index: 10;
        }
        .cd-header-buttons li {
            display: inline-block;
        }
        @media only screen and (max-width: 1169px) {
            .nav-on-left .cd-header-buttons {
                right: auto;
                left: 5%;
            }
            .nav-on-left .cd-header-buttons li {
                float: right;
            }
        }
        @media only screen and (min-width: 1170px) {
            .cd-header-buttons {
                top: 18px;
                left: 4em;
            }
        }
        .cd-search-trigger,
        .cd-nav-trigger {
            position: relative;
            display: block;
            width: 44px;
            height: 44px;
            overflow: hidden;
            white-space: nowrap;
            /* hide text */

            color: transparent;
            z-index: 3;
            margin-right: -8px;
        }
        .cd-search-trigger::before,
        .cd-search-trigger::after {
            /* search icon */

            content: '';
            position: absolute;
            -webkit-transition: opacity 0.3s;
            -moz-transition: opacity 0.3s;
            transition: opacity 0.3s;
            /* Force Hardware Acceleration in WebKit */

            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .cd-search-trigger::before {
            border: 1px solid #2e3233;
            border-radius: 50%;
            height: 15px;
            left: 13px;
            top: 13px;
            width: 15px;
        }
        .cd-search-trigger::after {
            /* handle */

            height: 3px;
            width: 8px;
            background: #2e3233;
            bottom: 14px;
            right: 11px;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .cd-search-trigger span {
            /* container for the X icon */

            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
        }
        .cd-search-trigger span::before,
        .cd-search-trigger span::after {
            /* close icon */

            content: '';
            position: absolute;
            display: inline-block;
            height: 2px;
            width: 22px;
            top: 50%;
            margin-top: -2px;
            left: 50%;
            margin-left: -11px;
            background: #2e3233;
            opacity: 0;
            /* Force Hardware Acceleration in WebKit */

            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            -moz-transition: opacity 0.3s, -moz-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
        }
        .cd-search-trigger span::before {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .cd-search-trigger span::after {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        .cd-search-trigger.search-is-visible::before,
        .cd-search-trigger.search-is-visible::after {
            /* hide search icon */

            opacity: 0;
        }
        .cd-search-trigger.search-is-visible span::before,
        .cd-search-trigger.search-is-visible span::after {
            /* show close icon */

            opacity: 1;
        }
        .cd-search-trigger.search-is-visible span::before {
            -webkit-transform: rotate(135deg);
            -moz-transform: rotate(135deg);
            -ms-transform: rotate(135deg);
            -o-transform: rotate(135deg);
            transform: rotate(135deg);
        }
        .cd-search-trigger.search-is-visible span::after {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .cd-nav-trigger span,
        .cd-nav-trigger span::before,
        .cd-nav-trigger span::after {
            /* hamburger icon in CSS */

            position: absolute;
            display: inline-block;
            height: 1px;
            width: 24px;
            background: #2e3233;
        }
        .cd-nav-trigger span {
            /* line in the center */

            position: absolute;
            top: 50%;
            right: 10px;
            margin-top: -2px;
            -webkit-transition: background 0.3s 0.3s;
            -moz-transition: background 0.3s 0.3s;
            transition: background 0.3s 0.3s;
        }
        .cd-nav-trigger span::before,
        .cd-nav-trigger span::after {
            /* other 2 lines */

            content: '';
            right: 0;
            /* Force Hardware Acceleration in WebKit */

            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transform-origin: 0% 50%;
            -moz-transform-origin: 0% 50%;
            -ms-transform-origin: 0% 50%;
            -o-transform-origin: 0% 50%;
            transform-origin: 0% 50%;
            -webkit-transition: -webkit-transform 0.3s 0.3s;
            -moz-transition: -moz-transform 0.3s 0.3s;
            transition: transform 0.3s 0.3s;
        }
        .cd-nav-trigger span::before {
            /* menu icon top line */

            top: -6px;
        }
        .cd-nav-trigger span::after {
            /* menu icon bottom line */

            top: 6px;
        }
        .cd-nav-trigger.nav-is-visible span {
            /* hide line in the center */

            background: rgba(46, 50, 51, 0);
        }
        .cd-nav-trigger.nav-is-visible span::before,
        .cd-nav-trigger.nav-is-visible span::after {
            /* keep visible other 2 lines */

            background: #2e3233;
        }
        .cd-nav-trigger.nav-is-visible span::before {
            -webkit-transform: translateX(4px) translateY(-3px) rotate(45deg);
            -moz-transform: translateX(4px) translateY(-3px) rotate(45deg);
            -ms-transform: translateX(4px) translateY(-3px) rotate(45deg);
            -o-transform: translateX(4px) translateY(-3px) rotate(45deg);
            transform: translateX(4px) translateY(-3px) rotate(45deg);
        }
        .cd-nav-trigger.nav-is-visible span::after {
            -webkit-transform: translateX(4px) translateY(2px) rotate(-45deg);
            -moz-transform: translateX(4px) translateY(2px) rotate(-45deg);
            -ms-transform: translateX(4px) translateY(2px) rotate(-45deg);
            -o-transform: translateX(4px) translateY(2px) rotate(-45deg);
            transform: translateX(4px) translateY(2px) rotate(-45deg);
        }
        @media only screen and (min-width: 1170px) {
            .cd-nav-trigger {
                display: none;
            }
        }
        .cd-primary-nav,
        .cd-primary-nav ul {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 260px;
            background: #2e3233;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            z-index: 10;
            /* Force Hardware Acceleration in WebKit */

            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
            -ms-transform: translateX(0);
            -o-transform: translateX(0);
            transform: translateX(0);
            -webkit-transition: -webkit-transform 0.3s;
            -moz-transition: -moz-transform 0.3s;
            transition: transform 0.3s;
        }
        .cd-primary-nav a,
        .cd-primary-nav ul a {
            display: block;
            text-align: right;
            height: 50px;
            font-size: 15px;
            line-height: 50px;
            padding: 0px 40px;
            color: #ffffff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            border-bottom: 1px solid #3a3f40;
            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            will-change: transform, opacity;
            -webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
            -moz-transition: -moz-transform 0.3s, opacity 0.3s;
            transition: transform 0.3s, opacity 0.3s;
        }
        .cd-primary-nav.is-hidden,
        .cd-primary-nav ul.is-hidden {
            /* secondary navigations hidden by default */

            -webkit-transform: translateX(100%);
            -moz-transform: translateX(100%);
            -ms-transform: translateX(100%);
            -o-transform: translateX(100%);
            transform: translateX(100%);
        }
        .cd-primary-nav.moves-out > li > a,
        .cd-primary-nav ul.moves-out > li > a {
            /* push the navigation items to the left - and lower down opacity - when secondary nav slides in */

            -webkit-transform: translateX(-100%);
            -moz-transform: translateX(-100%);
            -ms-transform: translateX(-100%);
            -o-transform: translateX(-100%);
            transform: translateX(-100%);
            opacity: 0;
        }
        @media only screen and (max-width: 1169px) {
            .nav-on-left .cd-primary-nav,
            .nav-on-left .cd-primary-nav ul {
                right: auto;
                left: 0;
            }
        }
        .cd-primary-nav .see-all a {
            /* different style for the See all button on mobile and tablet */

            color: #333;
        }
        .cd-primary-nav .cd-nav-gallery .cd-nav-item,
        .cd-primary-nav .cd-nav-icons .cd-nav-item {
            /* items with picture (or icon) and title */

            height: 80px;
            line-height: 80px;
        }
        .cd-primary-nav .cd-nav-gallery .cd-nav-item h3,
        .cd-primary-nav .cd-nav-icons .cd-nav-item h3 {
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .cd-primary-nav .cd-nav-gallery .cd-nav-item {
            padding-left: 90px;
        }
        .cd-primary-nav .cd-nav-gallery .cd-nav-item img {
            position: absolute;
            display: block;
            height: 40px;
            width: auto;
            left: 20px;
            top: 50%;
            margin-top: -20px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item {
            padding-left: 75px;
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item p {
            color: #2e3233;
            font-size: 1.3rem;
            /* hide description on small devices */

            display: none;
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item::before {
            /* item icon */

            content: '';
            display: block;
            position: absolute;
            top: 50%;
            margin-top: -20px;
            width: 40px;
            height: 40px;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 40px 40px;
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-1::before {
            background-image: url("../img/line-icon-1.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-2::before {
            background-image: url("../img/line-icon-2.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-3::before {
            background-image: url("../img/line-icon-3.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-4::before {
            background-image: url("../img/line-icon-4.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-5::before {
            background-image: url("../img/line-icon-5.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-6::before {
            background-image: url("../img/line-icon-6.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-7::before {
            background-image: url("../img/line-icon-7.svg");
        }
        .cd-primary-nav .cd-nav-icons .cd-nav-item.item-8::before {
            background-image: url("../img/line-icon-8.svg");
        }
        @media only screen and (max-width: 1169px) {
            .cd-primary-nav {
                /* by default .cd-primary-nav is hidden - trick for iOS devices where you can see the navigation if you pull down */

                visibility: hidden;
                -webkit-transition: visibility 0s 0.3s;
                -moz-transition: visibility 0s 0.3s;
                transition: visibility 0s 0.3s;
            }
            .cd-primary-nav.nav-is-visible {
                visibility: visible;
                -webkit-transition: visibility 0s 0s;
                -moz-transition: visibility 0s 0s;
                transition: visibility 0s 0s;
            }
        }
        @media only screen and (min-width: 1170px) {
            .cd-primary-nav {
                position: static;
                padding: 0 300px 0 0;
                height: auto;
                width: auto;
                float: right;
                overflow: visible;
                background: transparent;
            }
            .cd-primary-nav::after {
                clear: both;
                content: "";
                display: table;
            }
            .cd-primary-nav.moves-out > li > a {
                /* reset mobile style */

                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
                opacity: 1;
            }
            .cd-primary-nav ul {
                position: static;
                height: auto;
                width: auto;
                background: transparent;
                overflow: visible;
                z-index: 3;
            }
            .cd-primary-nav ul.is-hidden {
                /* reset mobile style */

                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
            }
            .cd-primary-nav ul.moves-out > li > a {
                /* reset mobile style */

                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
                opacity: 1;
            }
            .cd-primary-nav > li {
                float: right;
                margin-left: 1em;
            }
            .cd-primary-nav > li > a {
                /* main navigation buttons style */

                position: relative;
                display: inline-block;
                height: 80px;
                line-height: 80px;
                padding: 0px;
                color: #2e3233;
                overflow: visible;
                border-bottom: none;
                -webkit-transition: color 0.3s, box-shadow 0.3s;
                -moz-transition: color 0.3s, box-shadow 0.3s;
                transition: color 0.3s, box-shadow 0.3s;
                font-size: 15px;
            }
            .cd-primary-nav > li > a:hover {
                color: #333;
            }
            .cd-primary-nav > li > a.selected {
                color: #000;
                box-shadow: inset 0 -2px 0 #333;
            }
            .cd-primary-nav .go-back,
            .cd-primary-nav .see-all {
                display: none;
            }
            .cd-primary-nav .cd-secondary-nav {
                /* dropdown menu style */

                position: absolute;
                top: 80px;
                width: 100vw;
                background: #ffffff;
                padding: 27px 100px;
                box-shadow: inset 0 1px 0 #e2e3df, 0 3px 6px rgba(0, 0, 0, 0.05);
                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
                -webkit-transition: opacity .3s 0s, visibility 0s 0s;
                -moz-transition: opacity .3s 0s, visibility 0s 0s;
                transition: opacity .3s 0s, visibility 0s 0s;
            }
            .cd-primary-nav .cd-nav-icons {
                /* dropdown menu style */

                position: absolute;
                top: 80px;
                width: 100vw;
                background: #ffffff;
                padding: 27px 64px 10px;
                box-shadow: inset 0 1px 0 #e2e3df, 0 3px 6px rgba(0, 0, 0, 0.05);
                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
                -webkit-transition: opacity .3s 0s, visibility 0s 0s;
                -moz-transition: opacity .3s 0s, visibility 0s 0s;
                transition: opacity .3s 0s, visibility 0s 0s;
            }
            .cd-primary-nav .cd-nav-gallery {
                /* dropdown menu style */

                position: absolute;
                top: 80px;
                width: 100vw;
                background: #ffffff;
                padding: 50px 64px 50px;
                box-shadow: inset 0 1px 0 #e2e3df, 0 3px 6px rgba(0, 0, 0, 0.05);
                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
                -webkit-transition: opacity .3s 0s, visibility 0s 0s;
                -moz-transition: opacity .3s 0s, visibility 0s 0s;
                transition: opacity .3s 0s, visibility 0s 0s;
            }
            .cd-primary-nav .cd-secondary-nav::after,
            .cd-primary-nav .cd-nav-gallery::after,
            .cd-primary-nav .cd-nav-icons::after {
                clear: both;
                content: "";
                display: table;
            }
            .cd-primary-nav .cd-secondary-nav.is-hidden,
            .cd-primary-nav .cd-nav-gallery.is-hidden,
            .cd-primary-nav .cd-nav-icons.is-hidden {
                opacity: 0;
                visibility: hidden;
                -webkit-transition: opacity .3s 0s, visibility 0s .3s;
                -moz-transition: opacity .3s 0s, visibility 0s .3s;
                transition: opacity .3s 0s, visibility 0s .3s;
            }
            .cd-primary-nav .cd-secondary-nav > .see-all,
            .cd-primary-nav .cd-nav-gallery > .see-all,
            .cd-primary-nav .cd-nav-icons > .see-all {
                /* this is the BIG See all button at the bottom of the dropdown menu */

                display: block;
                position: absolute;
                left: 0;
                bottom: 0;
                height: 50px;
                width: 100%;
                overflow: hidden;
                /* reset some inherited style */

                margin: 0;
                padding: 0;
            }
            .cd-primary-nav .cd-secondary-nav > .see-all a,
            .cd-primary-nav .cd-nav-gallery > .see-all a,
            .cd-primary-nav .cd-nav-icons > .see-all a {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                font-size: 1.8rem;
                text-align: center;
                line-height: 50px;
                border-top: 1px solid #e2e3df;
                /* reset some inherited style */

                border-bottom: none;
                margin: 0;
                padding: 0;
                -webkit-transition: color 0.2s, background 0.2s, border 0.2s;
                -moz-transition: color 0.2s, background 0.2s, border 0.2s;
                transition: color 0.2s, background 0.2s, border 0.2s;
            }
            .cd-primary-nav .cd-secondary-nav > .see-all a:hover,
            .cd-primary-nav .cd-nav-gallery > .see-all a:hover,
            .cd-primary-nav .cd-nav-icons > .see-all a:hover {
                background: #2e3233;
                border-color: #2e3233;
                color: #ffffff;
            }
            .cd-primary-nav .cd-secondary-nav > li {
                /* change the height according to your needs - you can even set height: auto */

                height: 310px;
                /* here you set the number of columns - use width percentage */

                width: 23%;
                float: right;
                margin-left: 2.66%;
                border-left: 1px solid #e2e3df;
                overflow: hidden;
                overflow-x: hidden;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            .cd-primary-nav .cd-secondary-nav > li:nth-child(4n+2) {
                /* +2 because we have 2 list items with display:none */

                margin-left: 0;
                border-left: none;
            }
            .cd-primary-nav .cd-secondary-nav > li > a {
                /* secondary nav title */

                color: #333;
                font-weight: 500;
                font-size: 15px;
                margin-bottom: .4em;
                padding-bottom: 5px
            }
            .cd-primary-nav .cd-secondary-nav a {
                height: 30px;
                line-height: 30px;
                text-align: right;
                color: #777;
                border-bottom: none;
                font-size: 1.4rem;
            }
            .cd-primary-nav .cd-secondary-nav a:hover {
                color: #333;
            }
            .cd-primary-nav .cd-secondary-nav ul {
                /* Force Hardware Acceleration in WebKit */

                -webkit-transform: translateZ(0);
                -moz-transform: translateZ(0);
                -ms-transform: translateZ(0);
                -o-transform: translateZ(0);
                transform: translateZ(0);
            }
            .cd-primary-nav .cd-secondary-nav ul ul {
                /* tertiary navigation */

                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
            }
            .cd-primary-nav .cd-secondary-nav ul ul.is-hidden {
                -webkit-transform: translateX(100%);
                -moz-transform: translateX(100%);
                -ms-transform: translateX(100%);
                -o-transform: translateX(100%);
                transform: translateX(100%);
            }
            .cd-primary-nav .cd-secondary-nav ul ul .go-back {
                display: block;
            }
            .cd-primary-nav .cd-secondary-nav ul ul .go-back a {
                color: transparent;
            }
            .cd-primary-nav .cd-secondary-nav ul ul .see-all {
                display: block;
            }
            .cd-primary-nav .cd-secondary-nav .moves-out > li > a {
                /* push the navigation items to the left - and lower down opacity - when tertiary nav slides in */

                -webkit-transform: translateX(-100%);
                -moz-transform: translateX(-100%);
                -ms-transform: translateX(-100%);
                -o-transform: translateX(-100%);
                transform: translateX(-100%);
            }
            .cd-primary-nav .cd-nav-gallery li {
                /* set here number of columns - use width percentage */

                width: 15%;
                float: right;
                margin: 4% 4% 0px 0;
            }
            .cd-primary-nav .cd-nav-gallery li:nth-child(4n+2) {
                /* +2 because we have two additional list items with display:none */

                margin-right: 0;
            }
            .cd-primary-nav .cd-nav-gallery .cd-nav-item {
                border-bottom: none;
                padding: 0;
                height: auto;
                line-height: 1.2;
            }
            .cd-primary-nav .cd-nav-gallery .cd-nav-item img {
                position: static;
                margin-top: 0;
                height: auto;
                width: 100%;
                margin-bottom: .6em;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
                -webkit-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
            }
            .cd-primary-nav .cd-nav-gallery .cd-nav-item img:hover {
                opacity: 0.8;
                filter: Alpha(opacity=80);
                -webkit-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
            }
            .cd-primary-nav .cd-nav-gallery .cd-nav-item h3 {
                color: #333;
                font-size: 15px;
                text-align: center;
                font-weight: 500;
                margin-top: 20px;
            }
            .cd-primary-nav .cd-nav-icons li {
                /* set here number of columns - use width percentage */

                width: 32%;
                float: right;
                margin: 0 2% 20px 0;
            }
            .cd-primary-nav .cd-nav-icons li:nth-child(3n+2) {
                /* +2 because we have two additional list items with display:none */

                margin-right: 0;
            }
            .cd-primary-nav .cd-nav-icons .cd-nav-item {
                border-bottom: none;
                height: 80px;
                line-height: 1.2;
                padding: 24px 85px 0 0px;
                position: relative;
            }
            .cd-primary-nav .cd-nav-icons .cd-nav-item:hover {
                background: #f6f6f5;
            }
            .cd-primary-nav .cd-nav-icons .cd-nav-item h3 {
                color: #333;
                font-weight: 500;
                font-size: 15px;
                margin-top: 10px;
            }
            .cd-primary-nav .cd-nav-icons .cd-nav-item p {
                display: block;
            }
            .cd-primary-nav .cd-nav-icons .cd-nav-item::before {
                right: 25px;
            }
        }
        .has-children > a,
        .go-back a {
            position: relative;
        }
        .has-children > a::before,
        .has-children > a::after,
        .go-back a::before,
        .go-back a::after {
            /* arrow icon in CSS - for element with nested unordered lists */

            content: '';
            position: absolute;
            top: 50%;
            margin-top: -1px;
            display: inline-block;
            height: 2px;
            width: 10px;
            background: #464c4e;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .has-children > a::before,
        .go-back a::before {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .has-children > a::after,
        .go-back a::after {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        @media only screen and (min-width: 1170px) {
            .has-children > a::before,
            .has-children > a::after,
            .go-back a::before,
            .go-back a::after {
                background: #c9cbc4;
            }
            .has-children > a:hover::before,
            .has-children > a:hover::after,
            .go-back a:hover::before,
            .go-back a:hover::after {
                background: #000;
            }
        }
        .has-children > a {
            padding-right: 40px;
        }
        .has-children > a::before,
        .has-children > a::after {
            /* arrow goes on the right side - children navigation */

            right: 20px;
            -webkit-transform-origin: 0px 50% 0;
            -moz-transform-origin: 0px 50% 0;
            -ms-transform-origin: 0px 50% 0;
            -o-transform-origin: 0px 50% 0;
            transform-origin: 0px 50% 0;
        }
        .cd-primary-nav .go-back a {
            padding-left: 40px;
        }
        .cd-primary-nav .go-back a::before,
        .cd-primary-nav .go-back a::after {
            /* arrow goes on the left side - go back button */

            right: 20px;
            -webkit-transform-origin: 1px 50%;
            -moz-transform-origin: 1px 50%;
            -ms-transform-origin: 1px 50%;
            -o-transform-origin: 1px 50%;
            transform-origin: 1px 50%;
        }
        @media only screen and (min-width: 1170px) {
            .has-children > a::before,
            .has-children > a::after {
                right: 0;
            }
            .cd-primary-nav > .has-children > a {
                /* main navigation arrows on larger devices */

                padding-right: 30px !important;
            }
            .cd-primary-nav > .has-children > a::before,
            .cd-primary-nav > .has-children > a::after {
                width: 9px;
                -webkit-transform-origin: 50% 50%;
                -moz-transform-origin: 50% 50%;
                -ms-transform-origin: 50% 50%;
                -o-transform-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: #000;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                -webkit-transition: width 0.3s, -webkit-transform 0.3s;
                -moz-transition: width 0.3s, -moz-transform 0.3s;
                transition: width 0.3s, transform 0.3s;
            }
            .cd-primary-nav > .has-children > a::before {
                right: 12px;
            }
            .cd-primary-nav > .has-children > a::after {
                right: 7px;
            }
            .cd-primary-nav > .has-children > a.selected::before,
            .cd-primary-nav > .has-children > a.selected::after {
                width: 14px;
            }
            .cd-primary-nav > .has-children > a.selected::before {
                -webkit-transform: translateX(5px) rotate(-45deg);
                -moz-transform: translateX(5px) rotate(-45deg);
                -ms-transform: translateX(5px) rotate(-45deg);
                -o-transform: translateX(5px) rotate(-45deg);
                transform: translateX(5px) rotate(-45deg);
            }
            .cd-primary-nav > .has-children > a.selected::after {
                -webkit-transform: rotate(45deg);
                -moz-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                -o-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            .cd-secondary-nav > .has-children > a::before,
            .cd-secondary-nav > .has-children > a::after {
                /* remove arrows on secondary nav titles */

                display: none;
            }
            .cd-primary-nav .go-back a {
                padding-left: 20px;
            }
            .cd-primary-nav .go-back a::before,
            .cd-primary-nav .go-back a::after {
                right: 1px;
            }
        }
        .cd-search {
            position: absolute;
            height: 50px;
            width: 100%;
            top: 80px;
            left: 0;
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: opacity .3s 0s, visibility 0s .3s;
            -moz-transition: opacity .3s 0s, visibility 0s .3s;
            transition: opacity .3s 0s, visibility 0s .3s;
        }
        .cd-search form {
            height: 100%;
            width: 100%;
        }
        .cd-search input {
            border-radius: 0;
            border: none;
            background: #ffffff;
            height: 60px;
            width: 100%;
            padding: 0 5%;
            box-shadow: inset 0 1px 0 #e2e3df, 0 3px 6px rgba(0, 0, 0, 0.05);
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            direction: rtl;
        }
        .cd-search input::-webkit-input-placeholder {
            color: #999;
        }
        .cd-search input::-moz-placeholder {
            color: #999;
        }
        .cd-search input:-moz-placeholder {
            color: #999;
        }
        .cd-search input:-ms-input-placeholder {
            color: #999;
        }
        .cd-search input:focus {
            outline: none;
        }
        .cd-search.is-visible {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity .3s 0s, visibility 0s 0s;
            -moz-transition: opacity .3s 0s, visibility 0s 0s;
            transition: opacity .3s 0s, visibility 0s 0s;
        }
        .nav-is-fixed .cd-search {
            position: fixed;
        }
        @media only screen and (min-width: 1170px) {
            .cd-search {
                height: 120px;
                top: 80px;
            }
            .cd-search input {
                padding: 0 5em;
                font-size: 2rem;
                font-weight: 300;
                direction: rtl;
            }
        }
        .cd-overlay {
            /* shadow layer visible when navigation is active */

            position: fixed;
            z-index: 7;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            visibility: hidden;
            opacity: 0;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s, -webkit-transform 0.3s 0s;
            -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s, -moz-transform 0.3s 0s;
            transition: opacity 0.3s 0s, visibility 0s 0.3s, transform 0.3s 0s;
        }
        .cd-overlay.is-visible {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.3s 0s, visibility 0s 0s, -webkit-transform 0.3s 0s;
            -moz-transition: opacity 0.3s 0s, visibility 0s 0s, -moz-transform 0.3s 0s;
            transition: opacity 0.3s 0s, visibility 0s 0s, transform 0.3s 0s;
        }
        @media only screen and (max-width: 1169px) {
            .cd-overlay.is-visible {
                -webkit-transform: translateX(-260px);
                -moz-transform: translateX(-260px);
                -ms-transform: translateX(-260px);
                -o-transform: translateX(-260px);
                transform: translateX(-260px);
            }
            .nav-on-left .cd-overlay.is-visible {
                -webkit-transform: translateX(260px);
                -moz-transform: translateX(260px);
                -ms-transform: translateX(260px);
                -o-transform: translateX(260px);
                transform: translateX(260px);
            }
            .cd-overlay.is-visible.search-is-visible,
            .nav-on-left .cd-overlay.is-visible.search-is-visible {
                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
            }
        }
        /* --------------------------------

    support for no js

    -------------------------------- */

        .no-js .cd-primary-nav {
            position: relative;
            height: auto;
            width: 100%;
            overflow: visible;
            visibility: visible;
            z-index: 2;
        }
        .no-js .cd-search {
            position: relative;
            top: 0;
            opacity: 1;
            visibility: visible;
        }
        @media only screen and (min-width: 1170px) {
            .no-js .cd-primary-nav {
                position: absolute;
                z-index: 3;
                display: inline-block;
                width: auto;
                top: 0;
                right: 150px;
                padding: 0;
            }
            .no-js .nav-is-fixed .cd-primary-nav {
                position: fixed;
            }
        }
        .left.carousel-control span {
            background: url("../img/back.png") no-repeat left center;
            cursor: pointer;
            display: inline-block;
            height: 25px;
            left: 50px;
            position: absolute;
            top: 50%;
            width: 25px;
            z-index: 999;
        }
        .right.carousel-control span {
            background: url("../img/next.png") no-repeat right center;
            cursor: pointer;
            display: inline-block;
            height: 25px;
            right: 50px;
            position: absolute;
            top: 50%;
            width: 25px;
            z-index: 999;
        }
        .caption-slider {
            background: none;
            bottom: 0;
            color: #fff;
            font-size: 60px;
            position: absolute;
            z-index: 9;
            right: 49%;
        }
        .caption-slider:hover,
        .caption-slider:focus {
            background: transparent;
            color: #eee;
        }
        .btn-circle {
            animation-duration: 1.5s;
            animation-iteration-count: infinite;
            animation-name: updown;
            animation-timing-function: linear;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            display: inline-block;
            text-align: center;
        }
        @keyframes updown {
            0% {
                transform: translateY(-10px);
            }
            50% {
                transform: translateY(0px);
            }
            100% {
                transform: translateY(-10px);
            }
        }
        @keyframes updown {
            0% {
                transform: translateY(-10px);
            }
            50% {
                transform: translateY(0px);
            }
            100% {
                transform: translateY(-10px);
            }
        }
        .btn-circle i {
            transform: scale(1.2);
        }
        #section1 {
            background: url(../img/bg4.jpg) no-repeat top center/cover;
        }
        .top-banner {
            color: #fff;
            direction: rtl;
            padding: 20px;
            background: rgba(0, 0, 0, 0.6);
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .top-banner h1 {
            font-size: 25px;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 0px 1px 0px #333;
        }
        .top-banner p {
            font-size: 16px;
            margin-bottom: 30px;
            text-shadow: 0px 1px 0px #333;
        }
        .btn-more {
            padding: 0px 30px;
            color: #fff;
            font-weight: 500;
            background: #ef6203 url(../img/btn.jpg) right;
            font-size: 16px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            height: 40px;
            line-height: 40px;
        }
        .btn-more:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
        }
        .btn-google {
            width: 215px !important;
            background: url(../img/btngoogle.png) no-repeat;
            height: 40px;
            border: none;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            float: right;
            opacity: 0.9;
            filter: Alpha(opacity=90);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .btn-google:hover {
            opacity: 1;
            filter: Alpha(opacity=100);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .btn-google-register {
            width: 100% !important;
            background: url(../img/google.png) no-repeat;
            height: 40px;
            border: none;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            opacity: 0.9;
            filter: Alpha(opacity=90);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .btn-google-register:hover {
            opacity: 1;
            filter: Alpha(opacity=100);
            -webkit-transition: all 0.4s;
            transition: all 0.4s;
        }
        .top-slider {
            color: #fff;
            direction: rtl;
            text-align: center;
            position: absolute;
            top: 40%;
            width: 100%;
        }
        .top-slider h2 {
            font-size: 20px;
            text-shadow: 0px 1px 0px #333;
            margin-bottom: 20px;
        }
        .top-slider p {
            font-size: 17px;
            margin-bottom: 30px;
            text-shadow: 0px 1px 0px #333;
        }
        .page-scroll span {
            width: 100%;
            display: inline-block;
            font-size: 10px;
            text-shadow: 0px 1px 0px #333;
            text-align: center;
        }
        .social-networks-menu {
            float: left;
            left: 9em;
            position: relative;
            top: 25px;
            z-index: 999;
        }
        .social-networks-menu a {
            margin-right: 10px;
            direction: rtl;
            display: inline-block;
        }
        .social-networks-menu span {
            display: inline-block;
            padding: 0px 3px;
        }
        .login-link span {
            display: inline-block;
            font-size: 13px;
            margin-right: 3px;
        }
        .loginmodal-container {
            background: #fff;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            max-width: 350px;
            overflow: hidden;
            padding: 30px;
            width: 100%;
            border-radius: 4px;
        }
        .loginmodal-container h2 {
            color: #000;
            direction: rtl;
            font-size: 15px;
            margin: 0;
            text-align: center;
        }
        .loginmodal-container h3 {
            color: #000;
            direction: rtl;
            font-size: 12px;
            margin: 0;
            text-align: right;
        }
        .loginmodal-container h3 span {
            color: #ff8c3f;
        }
        .loginmodal-container h2 span {
            display: inline-block;
            padding: 5px 0;
            width: 100%;
        }
        .loginmodal-container input[type="submit"] {
            display: block;
            margin-top: 10px;
            position: relative;
        }
        .loginmodal-container input[type="text"],
        textarea,
        input[type="email"] {
            border: medium none;
            box-sizing: border-box;
            font-size: 12px;
            margin-bottom: 10px;
            width: 100%;
            border-radius: 4px;
            text-align: left;
            direction: ltr;
        }
        .loginmodal-container input[type="text"]:hover {
            border: medium none;
        }
        .loginmodal {
            font-size: 14px;
            font-weight: 700;
            height: 34px;
            padding: 0 8px;
            text-align: center;
        }
        .loginmodal-submit {
            background: url(../img/btn1.jpg) left;
            border: 0;
            color: #fff;
            font-size: 14px;
            padding: 0px 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            height: 40px;
            line-height: 40px;
        }
        .loginmodal-submit:hover {
            color: #fff;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: url(../img/btn1.jpg) right;
        }
        .loginmodal-container a {
            color: #222;
            display: inline-block;
            font-family: IRANSans;
            font-size: 13px;
            padding: 0 3px;
            text-align: center;
            text-decoration: none;
        }
        .loginmodal-container a:hover {
            color: #4868b1;
        }
        .login-help {
            color: #4868b1;
            font-size: 12px;
            text-align: center;
            margin-top: 15px;
        }
        .close-form {
            background: none;
            border: none;
            color: #333;
            font-size: 21px;
            left: -30px;
            line-height: 1;
            position: relative;
            top: -25px;
        }
        .close-modal {
            background: none;
            border: none;
            color: #333;
            font-size: 21px;
            left: 0px;
            line-height: 1;
            position: relative;
            top: 5px;
        }
        .bg-parallax {
            background-attachment: fixed;
            background-color: transparent;
            background-position: center center;
            background-size: cover;
            height: 100%;
            min-height: 100%;
        }
        .top-search-box {
            background: url(../img/menu-bg.png) repeat;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            padding: 10px 0px 0px 0px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            margin: 25px 0px;
            border: 1px solid #ddd;
        }
        .top-search-box h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            color: #4868b1;
        }
        .fr-label {
            float: right;
            margin: 10px 0px;
        }
        .btn-search {
            position: relative;
            right: 15px;
            padding: 0px 30px;
            color: #fff;
            font-weight: 500;
            background: #ef6203 url(../img/btn.jpg) right;
            font-size: 16px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            height: 37px;
            line-height: 45px;
        }
        .btn-search:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
        }
        .btn-search i {
            color: #fff;
            font-size: 20px;
            position: relative;
            top: -5px;
        }
        select + i.fa {
            color: #e44142;
            float: left;
            font-weight: 500;
            margin-left: 15px;
            margin-top: -25px;
            padding-right: 0;
            pointer-events: none;
        }
        select {
            -moz-appearance: none;
        }
        select + i.searchicon-top {
            color: #4868b1;
            float: left;
            margin-right: 0;
            padding-right: 0;
            pointer-events: none;
        }
        .search-jobs-box {
            background: url(../img/menu-bg.png) repeat;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 13px;
            direction: rtl;
            padding: 15px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: 1px solid #ddd;
        }
        .search-jobs-box:hover {
            background: #999;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .search-jobs-box:hover h2 {
            color: #fff;
        }
        .search-jobs-box:hover a {
            color: #fff;
        }
        .search-jobs-box:hover h3 {
            color: #fff;
        }
        .search-jobs-box h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .search-jobs-box img {
            width: 100px !important;
            height: 100px;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            background: #fff;
            margin: 0 auto 5px;
        }
        .search-jobs-box:hover .loc-jobs {
            color: #fff;
        }
        .search-jobs-box:hover .type-jobs {
            color: #fff;
        }
        .search-jobs-box h3 {
            margin-bottom: 5 px;
        }
        .loc-jobs i {
            font-size: 16px;
            color: #20232a;
            padding-left: 3px;
        }
        .loc-jobs {
            display: inline-block;
            width: 100%;
            margin-bottom: 5px;
        }
        .search-jobs-box:hover .loc-jobs i {
            font-size: 16px;
            color: #fff;
            padding-left: 3px;
        }
        .type-jobs {
            display: inline-block;
            width: 100%;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .search-jobs-box a {
            display: inline-block;
            width: 100px;
            height: 33px;
            overflow: hidden;
            line-height: 30px;
            text-align: center;
            color: #fff;
            background: #4868b1;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .search-jobs-box a:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #234491
        }
        .save-request {
            display: inline-block;
            width: 100px;
            height: 33px;
            overflow: hidden;
            line-height: 35px;
            text-align: center;
            color: #fff;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #56a748 !important;
        }
        .save-request:hover {
            background: #56a748 !important;
            color: #fff !important;
        }
        .jobs-carousel .owl-dots {
            display: none;
        }
        .jobs-carousel .owl-nav .owl-prev {
            background: transparent url("../img/c-left.png") no-repeat left center;
            cursor: pointer;
            display: inline-block;
            height: 47px;
            left: 0px;
            position: absolute;
            top: 40%;
            width: 42px;
            z-index: 999;
        }
        .jobs-carousel .owl-nav .owl-next {
            background: transparent url("../img/c-right.png") no-repeat right center;
            cursor: pointer;
            display: inline-block;
            height: 47px;
            position: absolute;
            right: 0px;
            top: 40%;
            width: 42px;
            z-index: 999;
        }
        .jobs-carousel.owl-nav .owl-prev:hover {
            background: transparent url("../img/c-left.png") no-repeat left center;
        }
        .jobs-carousel .owl-nav .owl-next:hover {
            background: transparent url("../img/c-right.png") no-repeat right center;
        }
        .bg-opacity {
            background: rgba(0, 0, 0, 0) linear-gradient(-45deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.2) 100%) repeat scroll 0 0;
            height: 100%;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: 100%;
            z-index: 1;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .wrap-event {
            position: relative;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 30px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrapper-events h2 {
            color: #4868b1;
            font-size: 20px;
            margin: 80px 0px 30px 0px;
            text-align: center;
        }
        .event-box {
            margin-bottom: 30px;
        }
        .wrap-event-box {
            bottom: 0;
            color: #fff;
            direction: rtl;
            height: 90%;
            padding: 15px 30px;
            position: absolute;
            text-align: center;
            width: 100%;
            z-index: 2;
        }
        .wrap-event-box h3 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 500
        }
        .wrap-event-box p {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .event-more {
            display: inline-block;
            width: 100px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: #fff;
            background: #4868b1;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            font-size: 15px;
        }
        .event-more:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #234491;
            color: #fff;
        }
        .date {
            display: inline-block;
            font-size: 13px;
            line-height: 30px;
            text-align: center;
            width: 100%;
        }
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:focus,
        .nav-tabs > li.active > a:hover {
            border-width: 0;
        }
        .nav-tabs > li > a {
            border: none;
            color: #666;
        }
        .nav-tabs > li.active > a,
        .nav-tabs > li > a:hover {
            border: none;
            color: #ff8c3f !important;
            background: transparent;
        }
        .nav-tabs > li > a::after {
            content: "";
            background: #ff8c3f;
            height: 2px;
            position: absolute;
            width: 100%;
            left: 0px;
            bottom: -1px;
            transition: all 250ms ease 0s;
            transform: scale(0);
        }
        .nav-tabs > li.active > a::after,
        .nav-tabs > li:hover > a::after {
            transform: scale(1);
        }
        .tab-nav > li > a::after {
            background: #21527d none repeat scroll 0% 0%;
            color: #fff;
        }
        .tab-pane {
            padding: 15px 0;
        }
        .tab-content {
            padding: 20px
        }
        @media only screen and (min-width: 991px) {
            .pp-section {
                height: 100%;
                position: absolute;
                width: 100%;
                overflow: hidden;
            }
            .pp-easing {
                -webkit-transition: all 1000ms cubic-bezier(0.550, 0.085, 0.000, 0.990);
                -moz-transition: all 1000ms cubic-bezier(0.550, 0.085, 0.000, 0.990);
                -o-transition: all 1000ms cubic-bezier(0.550, 0.085, 0.000, 0.990);
                transition: all 1000ms cubic-bezier(0.550, 0.085, 0.000, 0.990);
                /* custom */

                -webkit-transition-timing-function: cubic-bezier(0.550, 0.085, 0.000, 0.990);
                -moz-transition-timing-function: cubic-bezier(0.550, 0.085, 0.000, 0.990);
                -o-transition-timing-function: cubic-bezier(0.550, 0.085, 0.000, 0.990);
                transition-timing-function: cubic-bezier(0.550, 0.085, 0.000, 0.990);
                /* custom */
            }
            #pp-nav {
                position: fixed;
                z-index: 6;
                margin-top: -32px;
                top: 50%;
                opacity: 1;
            }
            #pp-nav.right {
                right: 17px;
            }
            #pp-nav.left {
                left: 17px;
            }
            .pp-section.pp-table {
                display: table;
            }
            .pp-tableCell {
                display: table-cell;
                vertical-align: middle;
                width: 100%;
                height: 100%;
            }
            .pp-slidesNav {
                position: absolute;
                z-index: 4;
                left: 50%;
                opacity: 1;
            }
            .pp-slidesNav.bottom {
                bottom: 17px;
            }
            .pp-slidesNav.top {
                top: 17px;
            }
            #pp-nav ul,
            .pp-slidesNav ul {
                margin: 0;
                padding: 0;
            }
            #pp-nav li,
            .pp-slidesNav li {
                display: block;
                width: 14px;
                height: 13px;
                margin: 7px;
                position: relative;
            }
            .pp-slidesNav li {
                display: inline-block;
            }
            #pp-nav li a,
            .pp-slidesNav li a {
                display: block;
                position: relative;
                z-index: 1;
                width: 100%;
                height: 100%;
                cursor: pointer;
                text-decoration: none;
            }
            #pp-nav li .active span,
            .pp-slidesNav .active span {
                background: #444;
            }
            #pp-nav span,
            .pp-slidesNav span {
                top: 2px;
                left: 2px;
                width: 8px;
                height: 8px;
                border: 1px solid #444 !important;
                background: rgba(0, 0, 0, 0);
                border-radius: 50%;
                position: absolute;
                z-index: 1;
            }
            .pp-tooltip {
                position: absolute;
                top: -2px;
                color: #fff;
                font-size: 14px;
                white-space: nowrap;
                max-width: 220px;
            }
            .pp-tooltip.right {
                right: 20px;
            }
            .pp-tooltip.left {
                left: 20px;
            }
            .pp-scrollable {
                overflow-y: scroll;
                height: 100%;
            }
        }
        .wrapper-news-box {
            text-align: right;
            direction: rtl;
            margin-bottom: 30px;
        }
        .wrapper-news-box img {
            position: relative;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: alpha(opacity=100);
            -moz-opacity: 1;
            -khtml-opacity: 1;
            opacity: 1;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrapper-news-box img:hover {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
            filter: alpha(opacity=80);
            -moz-opacity: 0.8;
            -khtml-opacity: 0.8;
            opacity: 0.8;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrapper-news-box h6 {
            font-size: 13px;
            padding: 0px;
            margin: 0px;
        }
        .wrapper-news-box h2 {
            margin: 0;
            max-height: 30px;
            overflow: hidden;
            padding: 0;
            text-align: right;
        }
        .wrapper-news-box h2 a {
            font-size: 14px;
            text-align: right;
            padding: 0px;
            margin: 0px;
            line-height: 25px;
            display: inline-block;
            color: #000;
            font-weight: 500;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrapper-news-box h2 a:hover {
            color: #4868b1;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrapper-news-box p {
            font-size: 13px;
            height: 45px;
            overflow: hidden;
            text-align: justify;
        }
        .more-txt-news {
            color: #ff9a30;
            display: inline-block;
            float: right;
            font-size: 12px;
            padding-top: 5px;
            width: 100%;
            font-weight: 500
        }
        .more-txt-news i {
            margin-right: 3px;
        }
        .wrapper-news-box p a:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #ff8c3f;
        }
        .news-date {
            font-size: 12px;
            color: #777;
            display: inline-block;
            width: 100%;
        }
        .footer {
            text-align: right;
            padding: 30px 0px;
        }
        .footer-home {
            direction: rtl
        }
        .col1-footer {
            text-align: right;
            margin-bottom: 30px;
        }
        .col1-footer h3 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .col1-footer img {
            position: relative;
            right: -5px;
            margin-left: 10px;
        }
        .contactus-footer img {
            position: relative;
            right: -5px;
            margin-left: 5px;
        }
        .col1-footer p {
            font-size: 14px;
            text-align: justify;
        }
        .col2-footer {
            text-align: right;
        }
        .col2-footer h3 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .links-footer h3 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .links-footer a {
            width: 100%;
            display: inline-block;
            direction: rtl;
            text-align: right;
            font-size: 14px;
        }
        .links-footer a:hover {
            color: #4868b1;
        }
        .part a {
            display: inline-block;
            width: 100%;
            font-size: 14px;
        }
        .col2-footer p {
            font-size: 14px;
            text-align: justify;
        }
        .part {
            margin-bottom: 30px;
        }
        .part img {
            right: -5px;
        }
        .col1-footer a {
            font-size: 12px;
            color: #ff8c3f;
            font-weight: 500;
        }
        .btn-newsletter {
            background: #4868b1;
            border: medium none;
            border-radius: 30px;
            color: #fff;
            padding: 7px 20px;
            text-align: center;
        }
        .btn-newsletter:hover {
            color: #fff
        }
        .input-newsletter {
            border: none;
            background: none;
        }
        .input-newsletter:focus {
            border: none;
        }
        .wrap-newsletter p {
            color: #666;
            font-size: 0.825rem;
            text-align: center;
        }
        .newsletter-input {
            direction: rtl;
        }
        .sn-icons {
            margin: 30px 0px;
        }
        .sn-icons img {
            border-radius: 50%;
            border: 1px solid #fff;
        }
        .sn-icons img:hover {
            border: 1px solid #20232A;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .input {
            position: relative;
            z-index: 1;
            display: inline-block;
            margin: 0.5em 1em .5em 1em;
            max-width: 250px;
            width: calc(100% - 2em);
            vertical-align: top;
        }
        .input__field {
            position: relative;
            display: block;
            float: left;
            padding: 0.6em;
            width: 60%;
            border: none;
            border-radius: 0;
            color: #aaa;
            -webkit-appearance: none;
            /* for box shadows to show on iOS */
        }
        .input__field:focus {
            outline: none;
        }
        .input__label {
            display: inline-block;
            float: right;
            padding: 0 1em;
            width: 40%;
            font-weight: 700;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .input__label-content {
            position: relative;
            display: block;
            padding: 1.6em 0;
            width: 100%;
            text-align: right
        }
        .graphic {
            position: absolute;
            top: 0;
            left: 0;
            fill: none;
        }
        .icon {
            color: #ddd;
            font-size: 150%;
        }
        /* Madoka */

        .input--madoka {
            margin: 1.1em 0;
            height: 40px;
        }
        .input__field--madoka {
            width: 100%;
            background: none !important;
            color: #7A7593;
            text-align: right;
            border: none !important;
        }
        .input__label--madoka {
            position: absolute;
            width: 100%;
            height: 100%;
            color: #ef6203;
            text-align: right;
            cursor: text;
        }
        .input__label-content--madoka {
            -webkit-transform-origin: 0% 50%;
            transform-origin: 0% 50%;
            -webkit-transition: -webkit-transform 0.3s;
            transition: transform 0.3s;
        }
        .graphic--madoka {
            -webkit-transform: scale3d(1, -1, 1);
            transform: scale3d(1, -1, 1);
            -webkit-transition: stroke-dashoffset 0.3s;
            transition: stroke-dashoffset 0.3s;
            pointer-events: none;
            stroke: #20232a;
            stroke-width: 3px;
            stroke-dasharray: 962;
            stroke-dashoffset: 558;
        }
        .input__field--madoka:focus + .input__label--madoka,
        .input--filled .input__label--madoka {
            cursor: default;
            pointer-events: none;
        }
        .input__field--madoka:focus + .input__label--madoka .graphic--madoka,
        .input--filled .graphic--madoka {
            stroke-dashoffset: 0;
        }
        .input__field--madoka:focus + .input__label--madoka .input__label-content--madoka,
        .input--filled .input__label-content--madoka {
            -webkit-transform: scale3d(0.81, 0.81, 1) translate3d(7em, 4em, 0);
            transform: scale3d(0.81, 0.81, 1) translate3d(7em, 4em, 0);
        }
        .btn-newsletter {
            padding: 0px 15px;
            color: #fff;
            background: #ef6203 url(../img/btn.jpg) right;
            font-size: 15px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            height: 40px;
            line-height: 40px;
            margin: 1.2em 0;
        }
        .btn-newsletter:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
        }
        .ml-15 {
            margin-left: 15px;
        }
        /*
    .col3-footer {
        margin-top: 20px;
    }
*/
        .copy-right {
            text-align: center;
            color: #333;
            direction: rtl;
            font-size: 12px;
            position: absolute;
            bottom: 0px;
            right: 0px;
            left: 0px;
            background: url(../img/menu-bg.png) repeat;
            padding: 10px;
            z-index: 9
        }
        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */

            color: #bbbbbb;
        }
        ::-moz-placeholder {
            /* Firefox 19+ */

            color: #bbbbbb;
        }
        :-ms-input-placeholder {
            /* IE 10+ */

            color: #bbbbbb;
        }
        :-moz-placeholder {
            /* Firefox 18- */

            color: #bbbbbb;
        }
        .cd-top {
            background: url("../img/totop.png") no-repeat;
            bottom: 0px;
            display: inline-block;
            height: 32px;
            opacity: 0;
            overflow: hidden;
            position: fixed;
            right: 10px;
            text-indent: 100%;
            transition: opacity 0.3s ease 0s, visibility 0s ease 0.3s;
            visibility: hidden;
            white-space: nowrap;
            width: 32px;
            z-index: 99;
        }
        .cd-top.cd-is-visible,
        .cd-top.cd-fade-out,
        .no-touch .cd-top:hover {
            transition: opacity 0.3s ease 0s, visibility 0s ease 0s;
        }
        .cd-top.cd-is-visible {
            opacity: 1;
            visibility: visible;
        }
        .cd-top.cd-fade-out {
            opacity: 0.5;
        }
        .wrapper-breadcrumb {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            background: #fff;
        }
        .page-breadcrumbs {
            list-style-type: none;
            margin: 0 5%;
            padding: 0;
        }
        .page-breadcrumbs li {
            direction: rtl;
            float: right;
            padding: 10px 0 10px 5px;
            font-size: 13px;
            text-align: right
        }
        .page-breadcrumbs li a {
            font-size: 13px;
            font-weight: 500;
        }
        .inner-content {
            background: #fff
        }
        .top-innerpage {
            height: 140px;
            width: 100%;
        }
        .top-innerpage-contact {
            height: 400px;
            width: 100%;
        }
        .top-innerpage h1 {
            color: #fff;
            text-align: right;
            padding: 49px 0px;
            font-size: 25px;
            font-weight: 500;
        }
        .top-address {
            border-bottom: 1px solid #ccc;
            font-size: 13px;
            text-align: right;
            direction: rtl;
            padding: 15px 0px
        }
        .r-address span {
            font-weight: 500;
        }
        .top-address p {
            line-height: 34px;
        }
        .date-jobs {
            margin-right: 10px;
        }
        .request-job a {
            padding: 5px 10px;
            color: #fff;
            background: #17a0f0 url(../img/btn2.jpg) right;
            font-size: 14px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: left;
        }
        .request-job a:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #17a0f0 url(../img/btn2.jpg) left;
        }
        .title-timejob {
            padding: 3px 15px;
            color: #f36236;
            border: 1px solid #f36236;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .title-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrap-content {
            padding: 20px 0px;
        }
        .left-jobs {
            direction: rtl;
            text-align: justify;
            font-size: 12px;
        }
        .left-jobs h3 {
            font-size: 14px;
            font-weight: 500;
            line-height: 25px;
        }
        .left-jobs p {
            padding: 10px 0px;
            text-align: justify;
        }
        .right-jobs {
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .j-part {
            padding: 10px 5px;
            text-align: right;
            direction: rtl;
            border-bottom: 1px solid #e5e5e5;
        }
        .j-part img {
            float: right;
            margin-left: 15px;
            position: relative;
            top: 10px
        }
        .j-part h3 {
            float: right;
            font-size: 12px;
            color: #000;
            font-weight: 500;
            display: inline-block;
            width: 100%;
        }
        .j-part h4 {
            float: right;
            font-size: 12px;
            color: #777;
            display: inline-block;
            width: 100%;
        }
        .j-part div {
            float: right
        }
        .part2-sidebar {
            border: 1px solid #e5e5e5;
            background: #f6f7fb;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .fr-img {
            border: 0px;
            outline: 0px;
            float: right;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-left: 15px;
        }
        .fr-img:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .fl-img {
            border: 0px;
            outline: 0px;
            float: left;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-right: 15px;
        }
        .fl-img:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            transition: all 0.4s;
        }
        .col1-part1 {
            padding: 15px;
            text-align: right
        }
        .col1-part1 h2 {
            color: #333;
            font-size: 15px;
            font-weight: 500;
        }
        .col1-part1 a {
            color: #555;
            font-size: 13px;
            font-weight: 400;
            display: inline-block;
            margin-bottom: 5px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .col1-part1 a:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #ff8c3f;
        }
        .r-btn {
            padding: 5px 15px;
            color: #fff !important;
            background: #ef6203 url(../img/btn.jpg) right;
            font-size: 12px !important;
            -webkit-border-top-right-radius: 30px;
            -webkit-border-bottom-right-radius: 30px;
            -moz-border-radius-topright: 30px;
            -moz-border-radius-bottomright: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            float: right;
            margin-left: 1px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            width: 120px !important;
            text-align: center
        }
        .l-btn {
            padding: 5px 15px;
            color: #fff !important;
            background: #ef6203 url(../img/btn.jpg) right;
            font-size: 12px !important;
            -webkit-border-top-left-radius: 30px;
            -webkit-border-bottom-left-radius: 30px;
            -moz-border-radius-topleft: 30px;
            -moz-border-radius-bottomleft: 30px;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            float: right;
            margin-left: 2px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            width: 120px !important;
            text-align: center
        }
        .r-btn:hover,
        .l-btn:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
        }
        .topslider .owl-dots {
            display: none;
        }
        .topslider .owl-nav .owl-prev {
            background: rgba(255, 255, 255, 0.5) url("../img/c-left.png") no-repeat center;
            cursor: pointer;
            display: inline-block;
            height: 22px;
            left: 10px;
            position: absolute;
            top: 45%;
            width: 13px;
            z-index: 999;
            padding: 15px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        .topslider .owl-nav .owl-next {
            background: rgba(255, 255, 255, 0.5) url("../img/c-right.png") no-repeat center;
            cursor: pointer;
            display: inline-block;
            height: 22px;
            position: absolute;
            right: 10px;
            top: 45%;
            width: 13px;
            z-index: 999;
            padding: 15px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        .topslider .owl-nav .owl-prev:hover {
            background: rgba(255, 255, 255, 0.4) url("../img/c-left.png") no-repeat center center;
        }
        .topslider .owl-nav .owl-next:hover {
            background: rgba(255, 255, 255, 0.4) url("../img/c-right.png") no-repeat center center;
        }
        .part2-sidebar {
            margin-bottom: 15px;
        }
        .ir-address {
            direction: rtl;
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .ir-address i {
            font-size: 15px;
            color: #e44144;
        }
        .l-address {
            direction: rtl;
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .l-address i {
            font-size: 15px;
            color: #e44144;
        }
        #map {
            width: 100%;
            height: 225px;
            border-top: 1px solid #e5e5e5;
        }
        #map-contact {
            width: 100%;
            height: 400px;
        }
        .wrap-icon {
            margin-top: 50px;
            margin-bottom: 15px;
        }
        .wrap-icon .pull-right a {
            margin-left: 5px;
        }
        .wrap-icon .pull-left a {
            margin-right: 2px;
        }
        .r-part {
            padding: 10px 0px;
            text-align: right;
            direction: rtl;
        }
        .r-part img {
            float: right;
            margin-left: 15px;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .r-part h3 {
            float: right;
            font-size: 12px;
            color: #000;
            font-weight: 500;
            display: inline-block;
            width: 100%;
        }
        .r-part h4 {
            float: right;
            font-size: 12px;
            color: #777;
            display: inline-block;
            width: 100%;
        }
        .r-part div {
            float: right
        }
        .title-rjobs {
            background: #f5f5f5 url('../img/arrow-down.png') no-repeat bottom right;
            border-bottom: 1px dotted #777;
            padding: 3px 10px;
            margin-bottom: 10px;
        }
        .title-rjobs h3 {
            font-weight: 500;
        }
        .r-part:last-child {
            border-bottom: none;
        }
        .wrapper-footer {
            background: #25262a;
        }
        .copyright {
            background: #1e1f21;
            padding: 10px;
            text-align: right;
            color: #fff;
            direction: rtl;
            font-size: 12px;
        }
        .copyright a {
            color: #fff
        }
        .icol1-footer img {
            position: relative;
            top: 5px;
        }
        .icol1-footer a {
            display: inline-block;
            margin-bottom: 20px;
            color: #ff8c3f;
            font-size: 12px;
            font-weight: 500;
        }
        .icol1-footer p {
            font-size: 12px;
            color: #fff;
            text-align: justify;
            direction: rtl;
        }
        .icol2-footer h3 {
            color: #fff;
            margin-bottom: 15px;
        }
        .icol2-footer p {
            font-size: 13px;
            color: #ccc;
        }
        .f-part {
            padding: 5px 0px;
            text-align: right;
            direction: rtl;
        }
        .f-part img {
            float: right;
            margin-left: 15px;
            border: 1px solid #1E1F21;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .f-part h3 {
            float: right;
            font-size: 10px;
            color: #fff;
            display: inline-block;
            width: 100%;
        }
        .f-part h4 a {
            color: #fff;
        }
        .f-part h4 {
            float: right;
            font-size: 13px;
            color: #fff;
            font-weight: 500;
            display: inline-block;
            width: 100%;
        }
        .f-part div {
            float: right
        }
        .icol3-footer h3 {
            color: #fff;
        }
        .footer-links a {
            display: inline-block;
            color: #fff;
            text-align: right;
            width: 100%;
            font-size: 13px;
            line-height: 30px;
            direction: rtl
        }
        .footer-links a:hover {
            color: #ddd
        }
        .address-footer {
            color: #fff;
            font-size: 13px;
        }
        .address-footer a {
            color: #fff;
            font-size: 13px;
            margin-top: 10px;
            display: inline-block
        }
        .address-footer i {
            color: #fff;
            font-size: 16px;
            margin-left: 10px;
        }
        .address-footer span {
            display: inline-block;
            font-weight: 500;
            font-size: 14px;
            width: 100%;
            direction: rtl;
        }
        .social-inner {
            margin-top: 30px;
        }
        .social-inner a {
            margin-left: 5px;
            display: inline-block
        }
        .social-inner img {
            width: 39px;
            height: 39px;
        }
        .icol1-footer,
        .icol2-footer,
        .icol3-footer {
            margin-bottom: 15px;
        }
        .btn-register {
            padding: 8px 15px;
            color: #222;
            background: #fff;
            font-size: 14px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            margin: 10px 0 30px;
            float: right;
        }
        .btn-register:hover {
            background: #ddd;
        }
        .footer-input {
            background: transparent !important;
            border: none !important;
            -webkit-border-radius: 0px !important;
            -moz-border-radius: 0px !important;
            border-radius: 0px !important;
            width: 170px !important;
            float: right;
            margin-left: 15px;
            border-bottom: 1px solid #fff !important;
            position: relative;
            top: 10px;
        }
        .contact-txt {
            direction: rtl;
            text-align: right !important;
        }
        .wrapper-blog {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            background-size: cover !important;
        }
        .blog {
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,ffffff+58&1+0,0+100 */

            background: -moz-linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.42) 58%, rgba(255, 255, 255, 0) 100%);
            /* FF3.6-15 */

            background: -webkit-linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.42) 58%, rgba(255, 255, 255, 0) 100%);
            /* Chrome10-25,Safari5.1-6 */

            background: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.42) 58%, rgba(255, 255, 255, 0) 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */

            filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff', GradientType=1);
            /* IE6-9 fallback on horizontal gradient */

            height: 100%;
            width: 100%;
        }
        .wrap-blog {
            position: absolute;
            bottom: 0px;
            right: 0px;
            padding: 20px;
        }
        .wrap-blog span {
            color: #e14f36;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .wrap-blog h2 {
            color: #000;
            font-size: 14px;
            font-weight: 500;
        }
        .wrap-blog p {
            color: #000;
            font-size: 12px;
            height: 95px;
            line-height: 23px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .wrap-blog a {
            color: #e14f36;
            font-size: 11px;
            position: absolute;
            bottom: 10px;
        }
        .lable-orangeblog {
            position: absolute;
            top: 20px;
            left: 0px;
            width: 50px;
            text-align: center;
            color: #fff;
            background: #ff9934;
            -webkit-border-top-right-radius: 20px;
            -webkit-border-bottom-right-radius: 20px;
            -moz-border-radius-topright: 20px;
            -moz-border-radius-bottomright: 20px;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            z-index: 1
        }
        .lable-greenblog {
            position: absolute;
            top: 20px;
            left: 0px;
            width: 50px;
            text-align: center;
            color: #fff;
            background: #049a91;
            -webkit-border-top-right-radius: 20px;
            -webkit-border-bottom-right-radius: 20px;
            -moz-border-radius-topright: 20px;
            -moz-border-radius-bottomright: 20px;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            z-index: 1
        }
        .wrap-horizontal-blog {
            position: relative
        }
        .wrap-horizontal-blog span {
            color: #e14f36;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .wrap-horizontal-blog h2 {
            color: #000;
            font-size: 14px;
            font-weight: 500;
        }
        .wrap-horizontal-blog p {
            color: #000;
            font-size: 12px;
            height: 66px;
            line-height: 23px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .wrap-horizontal-blog a {
            color: #e14f36;
            font-size: 11px;
            position: absolute;
            bottom: 10px;
        }
        .wrap-horizontal-blog img {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrap-horizontal-blog img:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .left-div {
            padding: 15px;
        }
        .fr-blog {
            float: right;
            margin-left: 15px;
            outline: 0 none;
            border-radius: 0 5px 5px 0;
        }
        .w-blog {
            margin-bottom: 15px;
        }
        .wrap-vertical-blog span {
            color: #e14f36;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .wrap-vertical-blog h2 {
            color: #000;
            font-size: 14px;
            font-weight: 500;
        }
        .wrap-vertical-blog p {
            color: #000;
            font-size: 12px;
            height: 66px;
            line-height: 23px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .wrap-vertical-blog a {
            color: #e14f36;
            font-size: 11px;
            position: absolute;
            bottom: 10px;
        }
        .wrap-vertical-blog img {
            width: 100%;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border-radius: 5px 5px 0px 0px;
        }
        .wrap-vertical-blog img:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrap-vertical-blog {
            position: relative
        }
        .inner-page {
            padding: 40px 0px;
            direction: rtl;
        }
        .cbp-view {
            text-align: center;
            margin: 10px 0px
        }
        .cbp-view a {
            padding: 2px 15px;
            color: #fff;
            background: #17a0f0 url(../img/btn2.jpg) right;
            font-size: 13px;
            transition: all 0.7s ease 0s;
            border: none;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
        }
        .cbp-view a:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #17a0f0 url(../img/btn2.jpg) left;
        }
        .title-leftside {
            background: #f5f5f5 url('../img/arrow-down.png') no-repeat bottom right;
            border-bottom: 1px dotted #777;
            padding: 3px 10px;
        }
        .l-part {
            direction: rtl;
            padding: 0;
            text-align: right;
        }
        .l-part a {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .l-part a:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .articles-date {
            color: #de5038;
            font-size: 12px;
        }
        .articles-part {
            padding: 10px 0px;
            text-align: right;
            direction: rtl;
            border-bottom: 1px dotted #777;
        }
        .articles-part img {
            float: right;
            margin-left: 15px;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .articles-part h3 {
        ;
            font-size: 12px;
            color: #000;
        }
        .articles-part a {
            font-weight: 500;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .articles-part a:hover {
            color: #888;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .wrap-rjobs {
            margin-bottom: 15px;
        }
        .detail-blog {
            direction: rtl;
            font-size: 15px;
        }
        .detail-blog h2 {
            font-weight: 500;
            margin-bottom: 10px;
        }
        .detail-blog p {
            direction: rtl;
            font-size: 14px;
            text-align: justify;
            font-size: 13px;
        }
        .detail-blog ol {
            list-style-type: decimal;
            padding: 0px 15px;
        }
        .detail-blog ul {
            list-style-type: circle;
            padding: 0px 15px;
        }
        .topbar-news {
            border-bottom: 1px solid #ccc;
            margin-bottom: 15px;
        }
        .topbar-news .pull-left a {
            margin-left: 5px;
        }
        .topbar-news .pull-left span {
            color: #e05038;
            font-size: 12px;
        }
        .imginner-blog {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
        .lable-blog a {
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background: #ff9934;
            color: #fff;
            text-align: center;
            padding: 0px 15px;
            font-size: 12px;
            margin-bottom: 10px;
            display: inline-block
        }
        .lable-news a {
            color: #ff9934;
            text-align: center;
            font-size: 12px;
            margin-bottom: 10px;
            display: inline-block;
            font-weight: 500;
        }
        .blockbox {
            width: 300px;
            float: right;
            border-right: 4px solid #ff9934;
            padding: 20px;
            background: #f5f5f5;
            font-size: 14px;
            font-weight: 500;
            text-align: justify;
            margin: 15px 0 0 20px;
        }
        .tags-news {
            height: 400px;
            text-align: right
        }
        .tags-news a {
            background: #ededed;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            margin-left: 2px !important;
            padding: 1px 7px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .tags-news a:hover {
            background: #ddd;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .tags a {
            background: #ededed;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            margin-left: 2px !important;
            padding: 2px 10px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .tags a:hover {
            background: #ddd;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .publisher {
            background: #f5f5f5 url("../img/arrow-down.png") no-repeat scroll right bottom;
            border-bottom: 1px dotted #777;
            padding: 15px;
            margin-bottom: 15px;
        }
        .publisher img {
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
        }
        .publisher h2 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 0;
        }
        .publisher h3 {
            font-size: 11px;
            color: #777;
        }
        .publisher p {
            font-size: 12px;
        }
        .publisher h4 {
            color: #e44142;
            font-size: 12px;
        }
        .btn-comment {
            padding: 5px 20px;
            color: #fff;
            font-weight: 500;
            background: #ef6203 url(../img/btn.jpg) right;
            font-size: 13px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            margin-right: 15px;
        }
        .btn-comment:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
        }
        .control-label {
            font-size: 13px;
            margin-top: 15px;
        }
        .ltr {
            direction: ltr !important;
        }
        .comments {
            background: #f5f5f5;
            border-bottom: 1px solid #ccc;
            padding: 15px;
        }
        .comments img {
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
        }
        .comments h2 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 0;
        }
        .comments h3 {
            font-size: 11px;
            color: #777;
            margin-bottom: 3px;
            line-height: 22px;
        }
        .comments p {
            font-size: 12px;
        }
        .comments h4 {
            color: #e44142 !important;
            font-size: 12px;
        }
        .wrap-comments {
            margin-bottom: 15px;
        }
        .comments-form {
            margin-bottom: 15px;
        }
        .np-page {
            height: 60px;
            line-height: 40px;
        }
        .np-page a {
            font-size: 13px;
            font-weight: 500;
        }
        .np-page a:hover {
            color: #ff9934;
        }
        .np-page .pull-right a img {
            padding-left: 10px;
        }
        .np-page .pull-left a img {
            padding-right: 10px;
        }
        .orange-cat {
            background: #ff9a30;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .red-cat {
            background: #e05038;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .green-cat {
            background: #049a8f;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .blue-cat {
            background: #0066ca;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .lightblue-cat {
            background: #17a0f0;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .pink-cat {
            background: #C64E6E;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .violet-cat {
            background: #9061C2;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 2px 10px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            color: #fff;
            float: right;
            margin-left: 5px;
        }
        .top-bannernews {
            height: 652px;
            margin-top: -80px;
            position: relative
        }
        .top-bannernews h1 {
            color: #fff;
            text-align: right;
            padding: 49px 0px;
            font-size: 25px;
            font-weight: 500;
        }
        .bg-parallax {
            background-attachment: fixed !important;
            background-color: transparent;
            background-position: center center;
            background-size: cover;
            height: 652px;
            min-height: 100%;
        }
        .row-news {
            direction: rtl;
            text-align: right;
            font-size: 13px;
        }
        .orange {
            color: #ff9a30;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .red {
            color: #e05038;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .green {
            color: #049a8f;
            font-size: 13px;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .blue {
            color: #0066ca;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .row-news h2 a {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 5px;
            text-decoration: none;
            color: #333;
        }
        .row-news a {
            font-size: 12px;

            text-decoration: underline;
            color: #FF9A30;
            font-weight: 500;
        }
        .date-news {
            bottom: 0;
            color: #e05038;
            display: inline-block;
            font-size: 12px;
        }
        .date-news img {
            position: relative;
            top: 3px;
            margin-left: 5px;
            margin-bottom: 0px;
            width: 16px;
            height: 16px;
        }
        .row-news {
            position: relative;
            border-bottom: 1px solid #ccc;
            padding: 20px 0px;
        }
        .wrap-row-news {
            margin-top: 5px;
        }
        .color1-timejob {
            padding: 3px 15px;
            color: #ec7063;
            border: 1px solid #ec7063;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color1-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color1-timejob-grid {
            color: #ec7063;
        }
        .color2-timejob {
            padding: 3px 15px;
            color: #f1c40f;
            border: 1px solid #f1c40f;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color2-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color2-timejob-grid {
            color: #f1c40f;
        }
        .color3-timejob {
            padding: 3px 15px;
            color: #9588b2;
            border: 1px solid #9588b2;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color3-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color3-timejob-grid {
            color: #9588b2;
        }
        .color4-timejob {
            padding: 3px 15px;
            color: #95a5a6;
            border: 1px solid #95a5a6;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color4-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color4-timejob-grid {
            color: #95a5a6;
        }
        .color5-timejob {
            padding: 3px 15px;
            color: #1abc9c;
            border: 1px solid #1abc9c;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color5-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color5-timejob-grid {
            color: #1abc9c;
        }
        .color6-timejob {
            padding: 3px 15px;
            color: #af7ac5;
            border: 1px solid #af7ac5;
            font-weight: 500;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: right;
            margin-left: 20px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color6-timejob:hover {
            border: 1px solid #000;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .color6-timejob-grid {
            color: #af7ac5;
        }
        .wrap-date-news {
            margin-top: 30px;
        }
        .left-jobs h4 {
            color: #666;
        }
        .save {
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            background: #ef6203 url(../img/btn.jpg) right;
            color: #fff;
            text-align: center;
            padding: 3px 25px;
            font-size: 14px;
            margin-bottom: 10px;
            display: inline-block;
            border: none;
            margin-top: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .save:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
            display: inline-block;
            font-weight: 500;
        }
        select + i.tb-icon {
            color: #e44142;
            display: inline-block;
            float: left;
            left: -5px;
            margin: 0 auto;
            padding-top: 15px;
            pointer-events: none;
            position: absolute;
            text-align: center;
            top: -4px;
            width: 45px;
        }
        .add-row-PHD-table,
        .add-row-ProfesstionalTrainingRecords,
        .add-row-ForeignLanguage,
        .add-row-computerSkill,
        .add-row-experimental,
        .add-row-CPHD-table,
        .add-row-BSC-table,
        .add-row-MSC-table,
        .add-row-Diploma-table,
        .add-row-introducer,
        .add-row-AD-table,
        .add-row-savabeghamo {
            background: #e44142;
            border: 0;
            color: #fff;
            font-size: 13px;
            height: 20px;
            line-height: 23px;
            text-align: center;
            width: 26px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .add-row-family,
        .add-row-savabgh,
        .add-row-mahzaban,
        .add-row-mahcom {
            background: #e44142;
            border: 0;
            color: #fff;
            font-size: 13px;
            height: 20px;
            line-height: 23px;
            text-align: center;
            width: 26px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .remove-row {
            background: #999;
            border: medium none;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            height: 20px;
            line-height: 23px;
            text-align: center;
            width: 26px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .star {
            color: #e44142;
            font-weight: 700;
            font-size: 18px;
            display: inline-block;
            position: absolute;
            right: 0px;
            top: 28px
        }
        .stars {
            color: #e44142;
            font-weight: 700;
            font-size: 15px;
            height:20px;
            display: inline-block;
        }
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #777;
            direction: rtl;
            display: block;
            font-size: 12px;
            height: 34px;
            line-height: 1.42857;
            padding: 6px 12px;
        }
        .title-address {
            color: #da4348 !important;
            padding: 30px 15px 0px 15px;
        }
        .wrapper-learn-table {
            overflow-x: auto;
            padding: 0;
            border: 1px solid #ddd;
        }
        .wrapper-family-table {
            overflow-x: auto;
            padding: 0;
        }
        input[type="text"] {
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #777;
            direction: rtl;
            font-size: 12px;
            line-height: 1.42857;
            padding: 6px 12px;
        }
        .panel-heading .accordion-toggle:after {
            /* symbol for "opening" panels */

            font-family: 'FontAwesome';
            /* essential for enabling glyphicon */

            content: "\f053";
            /* adjust as needed, taken from bootstrap.css */

            float: left;
            /* adjust as needed */

            color: #56a748;
            /* adjust as needed */

            position: relative;
            top: 5px
        }
        .panel-heading .accordion-toggle {
            color: #000;
            display: inline-block;
            width: 100%;
        }
        .panel-heading .accordion-toggle.collapsed:after {
            /* symbol for "collapsed" panels */

            content: "\f078";
            /* adjust as needed, taken from bootstrap.css */
        }
        .panel-body ul {
            direction: rtl;
            font-size: 12px;
            text-align: right;
            border-right: 1px solid #56a748;
        }
        .panel-body ul li {
            padding-right: 10px;
        }
        .panel-body ul li a {
            color: #999
        }
        .panel-body ul li a:hover {
            color: #56a748
        }
        .panel-title a img {
            direction: rtl;
            float: right;
            margin-left: 10px;
            margin-top: 3px;
        }
        .panel-title a:hover {
            color: #56a748
        }
        .complete-resume {
            background: #f3f3f3;
            padding: 10px 15px;
            font-size: 13px;
            text-align: right;
            direction: rtl;
            margin-bottom: 20px;
        }
        .complete-resume h4 {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .complete-resume span {
            font-weight: normal;
            font-size: 13px;
        }
        .num-request h6 {
            font-size: 13px;
        }
        .num-request span {
            font-size: 25px;
            font-weight: 500;
        }
        .num-request {
            height: 82px;
            border: 1px solid #ddd;
            direction: rtl;
            text-align: right;
            margin-bottom: 20px;
        }
        .num-request div {
            padding: 15px;
            float: right
        }
        .num-request img {
            float: left;
        }
        .company-logo {
            border: 1px solid #ddd;
            width: 60px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .fag-content {
            border-top: 1px solid #ddd;
            padding: 15px 0px !important;
        }
        .fag-content textarea {
            margin-bottom: 0px;
        }
        .top-searchjob {
            border-bottom: 1px solid #ddd;
            direction: rtl;
            padding: 10px 0px;
        }
        .top-searchjob .pull-right {
            font-size: 14px;
            font-weight: 500;
        }
        .top-searchjob .pull-left {
            font-size: 12px;
            font-weight: 500;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .switch input {
            display: none;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ff6d6e;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        input:checked + .slider {
            background-color: #ff6d6e;
        }
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        /* Rounded sliders */

        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .features {
            position: relative;
            font-size: 16px;
            color: #555;
            background: #fff;
        }
        .features .self {
            color: #555;
            border-bottom-color: #bbb;
        }
        .features .self:hover {
            color: #222
        }
        .features .arrows {
            top: 0
        }
        .features:hover .arrows .bottom {
            left: 0
        }
        .features h2 {
            color: #fff;
            background: #2489c5
        }
        .features ul {
            padding: 44px 60px 36px
        }
        .features li {
            padding: 0 0 9px 36px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABI0lEQVR4XpXSP0vDUBjF4ZtLkIr4EYzduogdXJTWWV2FLMVNoQrdAhlUUFAEcejo1q13svgFBAUdxA/g30kcdQoIIlL9DWcKuZEeeOCl99w3gTSI49h4MoFb/KCJz6KShS/rOh/TbEZZECLBiSQIR1nQQgAnAVr/LZjEnIq76OJbutjRGR26isUB3pDhBikucWoUzVdI1cl05zBk2MI5jvCKIfL5QluzxTS20bY6WENdl0ujTl13Ni3DABtwWEFp1HG6M7Aq9NHBGRbgy7w6HfTzX6GHCyyXPV2dnu9/MIUX+PIMOkRsbq7hHkZmxciDOrZoQRUVPCGCw504RDobR7VoQQ0f2Mejls1IRb/t4R10CcLc6/2igSVcw8gqFnEMOnSVPxQqQaPw2y7fAAAAAElFTkSuQmCC") 0 1px no-repeat;
            *background-image: url("ie/icon-star.png");
        }
        .features li.offset {
            margin-top: 20px
        }
        .mark {
            padding: 0 2px;
            color: #777;
            background: #e7e5e0;
        }
        .skin-polaris .mark {
            background: #232830
        }
        .skin-futurico .mark {
            background: #25262a
        }
        .social {
            height: 60px;
            margin-bottom: 60px;
            padding: 0 60px;
            font-size: 16px;
            color: #555;
            background: #f5f3ef;
        }
        .social a {
            color: #777;
            border-bottom-color: #ccc;
        }
        .social a:hover {
            color: #444
        }
        .social .left {
            float: left;
            padding-top: 19px;
        }
        .social .left li {
            float: left;
            padding-right: 30px;
        }
        .social .left li a {
            position: relative
        }
        .social .right {
            float: right;
            padding-top: 20px;
        }
        .social .right li {
            float: right;
            padding-left: 10px
        }
        .social .right.local {
            padding-top: 19px;
        }
        .social .right.local li {
            padding-left: 30px;
            font-size: 14px
        }
        .demo-holder {
            margin-bottom: 97px
        }
        .demo-title {
            padding-bottom: 36px;
            font-size: 26px;
            letter-spacing: -1px
        }
        .demo {
            position: relative;
        }
        .demo:hover .arrows .top,
        .demo:hover .arrows .bottom {
            left: 0
        }
        .demo-list {
            position: relative;
            margin-right: 360px;
            padding: 33px 57px 17px;
            color: #555;
            background: #fff;
            border: 3px solid #ddd8ce;
        }
        .demo-list ul {
            float: right;
            white-space: nowrap;
        }
        .demo-list ul:first-child {
            float: left
        }
        .demo-list ul li {
            position: relative;
            padding: 0 0 18px 42px
        }
        .demo-list ul input {
            position: absolute;
            top: 4px;
            left: 0
        }
        .demo-list ul .icheckbox_square-blue,
        .demo-list ul .iradio_square-blue {
            position: absolute;
            top: -1px;
            left: 0
        }
        .demo-list ul span {
            color: #bbb
        }
        .demo-methods {
            padding: 21px 360px 0 0;
        }
        .demo-methods .mark {
            background: #d3cfc6
        }
        .demo-methods dt {
            position: relative;
            padding: 17px 150px 18px 0;
            font: 16px/24px 'MontserratRegular', Helvetica, Arial, sans-serif;
            color: #444;
            border-bottom: 3px solid #ddd8ce;
        }
        .demo-methods dt .self {
            cursor: pointer;
        }
        .demo-methods dt .self:hover {
            color: #222
        }
        .demo-methods dt .code {
            position: absolute;
            right: 0;
            bottom: 18px;
            color: #777;
        }
        .demo-methods dt .code .self:hover {
            color: #444
        }
        .demo-methods dd {
            position: relative;
            display: none;
            margin: 0;
            background: #fff;
            border: 3px solid #ddd8ce;
            border-top: none;
        }
        .demo-methods dd:before {
            content: '';
            position: absolute;
            top: -13px;
            left: 0;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-bottom-color: #ddd8ce;
            border-left-color: #ddd8ce
        }
        .demo-methods dd .markup {
            margin: 0;
            color: #888;
            background: #f5f3ef;
            border: none;
        }
        .demo-methods dd .markup .comment {
            color: #aaa
        }
        .demo-callbacks {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 300px;
            color: #aaa;
            background: #232323;
            border: 3px solid #ddd8ce;
        }
        .demo-callbacks h2 {
            color: #fff;
            background: #6a5a8c
        }
        .demo-callbacks ul {
            position: absolute;
            top: 60px;
            width: 100%;
            bottom: 0;
            overflow: auto;
        }
        .demo-callbacks ul::-webkit-scrollbar {
            width: 10px;
            background: none;
        }
        .demo-callbacks ul::-webkit-scrollbar-track {
            background: none;
            border: none;
        }
        .demo-callbacks ul::-webkit-scrollbar-track-piece:disabled {
            display: none !important;
        }
        .demo-callbacks ul::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .25);
            border: none;
        }
        .demo-callbacks ul::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, .3);
        }
        .demo-callbacks ul li {
            margin-top: -1px;
            padding: 13px 20px 15px;
            border-top: 1px solid #2e2e2e;
        }
        .demo-callbacks ul li span {
            color: #888
        }
        .skins {
            position: relative;
            *zoom: 1;
        }
        .skins h2 {
            position: absolute;
            top: -38px;
            right: 0;
            left: 0;
            font-size: 24px;
            text-align: center
        }
        .arrows {
            position: absolute;
            top: 3px;
            left: -60px;
            width: 60px;
            overflow: hidden;
        }
        .arrows .top,
        .arrows .bottom {
            position: relative;
            left: 60px;
            width: 60px;
            height: 60px;
            cursor: pointer;
            -webkit-transition: left .3s, background-color .2s;
            -moz-transition: left .3s, background-color .2s;
            -ms-transition: left .3s, background-color .2s;
            -o-transition: left .3s, background-color .2s;
            transition: left .3s, background-color .2s
        }
        .arrows .top {
            background: #83b3be url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAALCAYAAACZIGYHAAAAdklEQVR4Xo3MuwmFQBiE0b0FmAuutnRBsAARLMTYRzvWItiEYLq/s6CYyMwGXzTDcWbG8mhEf/ZjQIV2ZCigjiASMAVJIAVKAQ4FKWBDJVoYpAB/7z8GRaAQgBNQG8dZA28f0BmHBgUCKGh9hhpNKH8BWY8GlF2OH3hCC1zmdAAAAABJRU5ErkJggg==") 50% no-repeat;
            *background-image: url("ie/arrow-top.png");
        }
        .arrows .top:hover {
            background-color: #6ba4b1
        }
        .arrows .bottom {
            background: #e2b78d url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAALCAYAAACZIGYHAAAAf0lEQVR4Xo3MzQmEQBCE0TGAvQuOpiQIBiCCgXj2J52NRTAJwev0Vh+WOgjlNHyHguYFM/M6tKLSd2YTmtHHR48S8jtQzAB2430d2bgJvQLsdqRCZwZUPAFLaPjrjYAUMKLgwBtUK4CIhi4BEFGQBohISANEJKQBIqqIFtSqvx/0bXhCCUrgiAAAAABJRU5ErkJggg==") 50% no-repeat;
            *background-image: url("ie/arrow-bottom.png");
        }
        .arrows .bottom:hover {
            background-color: #dba571
        }
        @media screen and (max-width: 1049px) {
            .arrows,
            .fork-me {
                display: none
            }
        }
        .skin {
            position: relative;
            margin-bottom: 40px;
        }
        .skin:hover .arrows .top,
        .skin:hover .arrows .bottom {
            left: 0
        }
        .skin h3 {
            position: relative;
            z-index: 20;
            float: left;
            height: 60px;
            padding: 0 57px;
            line-height: 58px;
            background: #fff;
            border: 3px solid #ddd8ce;
            border-bottom: none;
        }
        .skin h3:before {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 2px;
            margin-top: -1px;
            background: #fff
        }
        .skin.skin-polaris h3 {
            color: #cacdd1;
            background: #2c323c;
        }
        .skin.skin-polaris h3:before {
            background: #2c323c
        }
        .skin.skin-futurico h3 {
            color: #c3c3c3;
            background: #2e3035;
        }
        .skin.skin-futurico h3:before {
            background: #2e3035
        }
        .skin dl {
            z-index: 10;
            width: 100%;
            margin: 0
        }
        .skin dt {
            position: relative;
            top: -53px;
            right: -3px;
            float: right;
            height: 47px;
            margin-right: -3px;
            padding: 0 57px;
            line-height: 47px;
            border: 3px solid #ddd8ce;
            cursor: pointer;
        }
        .skin dt:hover {
            background: #f0ede7;
            border-bottom: 3px solid #ddd8ce
        }
        .skin dt.selected {
            height: 50px;
            background: #fff;
            border-bottom: none;
            cursor: default;
        }
        .skin dt.selected:before {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 2px;
            margin-top: -1px;
            background: #fff
        }
        .skin.skin-polaris dt {
            color: #cacdd1;
            background: #647083;
        }
        .skin.skin-polaris dt:hover {
            background: #4a5361
        }
        .skin.skin-polaris dt.selected {
            background: #2c323c;
        }
        .skin.skin-polaris dt.selected:before {
            background: #2c323c
        }
        .skin.skin-futurico dt {
            color: #c3c3c3;
            background: #676c77;
        }
        .skin.skin-futurico dt:hover {
            background: #4b4e56
        }
        .skin.skin-futurico dt.selected {
            background: #2e3035;
        }
        .skin.skin-futurico dt.selected:before {
            background: #2e3035
        }
        .skin dd {
            position: relative;
            display: none;
            float: left;
            width: 100%;
            margin: -3px -100% 0 0;
            overflow: hidden;
            color: #444;
            background: #fff;
            border: 3px solid #ddd8ce;
        }
        .skin dd.selected {
            display: block
        }
        .skin dd a {
            color: #444;
        }
        .skin dd a:hover {
            color: #111
        }
        .skin.skin-polaris dd {
            color: #7a828b;
            background: #2c323c;
        }
        .skin.skin-polaris dd a {
            color: #7a828b;
            border-bottom-color: #4e596b;
        }
        .skin.skin-polaris dd a:hover {
            color: #a2a7ae
        }
        .skin.skin-futurico dd {
            color: #888;
            background: #2e3035;
        }
        .skin.skin-futurico dd a {
            color: #888;
            border-bottom-color: #545861;
        }
        .skin.skin-futurico dd a:hover {
            color: #aaa
        }
        .skin-section {
            float: right;
            background: #fff;
            line-height: 18px;
            width: 100%;
            margin-bottom: 5px;
        }
        .half-width .list li span {
            float: none !important;
        }
        .skin-section h4 {
            padding-bottom: 18px;
        }
        .skin-polaris .skin-section h4 {
            color: #959ba2
        }
        .skin-futurico .skin-section h4 {
            color: #a0a0a0
        }
        .skin-section .list {
            border-right: none;
            direction: rtl;
            font-size: 12px;
            line-height: 20px;
            text-align: right;
        }
        .skin-section .list li span {
            float: left
        }
        .skin-section .list li {
            position: relative;
            padding-bottom: 10px;
            padding-right: 25px;
        }
        .skin-minimal .skin-section .list li {
            padding-left: 38px
        }
        .skin-square .skin-section .list li {
            padding-left: 42px
        }
        .skin-flat .skin-section .list li,
        .skin-line .skin-section label {
            padding-left: 40px
        }
        .skin-line .skin-section h4 {
            padding-bottom: 24px
        }
        .skin-line .skin-section .list {
            padding-right: 40px;
        }
        .skin-line .skin-section .list li {
            padding-bottom: 10px
        }
        .skin-polaris .skin-section .list li {
            padding-left: 37px
        }
        .skin-futurico .skin-section .list li {
            padding-left: 36px
        }
        .icheckbox_minimal,
        .icheckbox_minimal-red,
        .icheckbox_minimal-green,
        .icheckbox_minimal-blue,
        .icheckbox_minimal-aero,
        .icheckbox_minimal-grey,
        .icheckbox_minimal-orange,
        .icheckbox_minimal-yellow,
        .icheckbox_minimal-pink,
        .icheckbox_minimal-purple,
        .iradio_minimal,
        .iradio_minimal-red,
        .iradio_minimal-green,
        .iradio_minimal-blue,
        .iradio_minimal-aero,
        .iradio_minimal-grey,
        .iradio_minimal-orange,
        .iradio_minimal-yellow,
        .iradio_minimal-pink,
        .iradio_minimal-purple {
            position: absolute;
            top: 1px;
            left: 0
        }
        .skin input[type=checkbox],
        .skin input[type=radio] {
            position: absolute;
            top: 2px;
            left: 0
        }
        .icheckbox_square,
        .icheckbox_square-red,
        .icheckbox_square-green,
        .icheckbox_square-blue,
        .icheckbox_square-aero,
        .icheckbox_square-grey,
        .icheckbox_square-orange,
        .icheckbox_square-yellow,
        .icheckbox_square-pink,
        .icheckbox_square-purple,
        .iradio_square,
        .iradio_square-red,
        .iradio_square-green,
        .iradio_square-blue,
        .iradio_square-aero,
        .iradio_square-grey,
        .iradio_square-orange,
        .iradio_square-yellow,
        .iradio_square-pink,
        .iradio_square-purple {
            position: absolute;
            top: -1px;
            left: 0
        }
        .icheckbox_flat,
        .icheckbox_flat-red,
        .icheckbox_flat-green,
        .icheckbox_flat-blue,
        .icheckbox_flat-aero,
        .icheckbox_flat-grey,
        .icheckbox_flat-orange,
        .icheckbox_flat-yellow,
        .icheckbox_flat-pink,
        .icheckbox_flat-purple,
        .iradio_flat,
        .iradio_flat-red,
        .iradio_flat-green,
        .iradio_flat-blue,
        .iradio_flat-aero,
        .iradio_flat-grey,
        .iradio_flat-orange,
        .iradio_flat-yellow,
        .iradio_flat-pink,
        .iradio_flat-purple {
            position: absolute;
            top: 0;
            right: 0
        }
        .icheckbox_polaris,
        .iradio_polaris {
            position: absolute;
            top: -4px;
            left: -6px
        }
        .icheckbox_futurico,
        .iradio_futurico {
            position: absolute;
            top: 2px;
            left: 0
        }
        .skin-states {
            float: right;
            padding-right: 57px;
            padding-left: 0;
        }
        .skin-states .state {
            cursor: default !important
        }
        .skin-states .list {
            padding-right: 0
        }
        .skin-minimal .skin-states .list li {
            padding-left: 71px
        }
        .skin-square .skin-states .list li {
            padding-left: 79px
        }
        .skin-flat .skin-states .list li {
            padding-left: 75px
        }
        .skin-line .skin-states .list {
            padding-right: 0
        }
        .skin-polaris .skin-states .list li {
            padding-left: 69px
        }
        .skin-futurico .skin-states .list li {
            padding-left: 67px
        }
        .skin-states .iradio_minimal,
        .skin-states .iradio_minimal-red,
        .skin-states .iradio_minimal-green,
        .skin-states .iradio_minimal-blue,
        .skin-states .iradio_minimal-aero,
        .skin-states .iradio_minimal-grey,
        .skin-states .iradio_minimal-orange,
        .skin-states .iradio_minimal-yellow,
        .skin-states .iradio_minimal-pink,
        .skin-states .iradio_minimal-purple {
            left: 33px
        }
        .skin-states .iradio_square,
        .skin-states .iradio_square-red,
        .skin-states .iradio_square-green,
        .skin-states .iradio_square-blue,
        .skin-states .iradio_square-aero,
        .skin-states .iradio_square-grey,
        .skin-states .iradio_square-orange,
        .skin-states .iradio_square-yellow,
        .skin-states .iradio_square-pink,
        .skin-states .iradio_square-purple {
            left: 37px
        }
        .skin-states .iradio_flat,
        .skin-states .iradio_flat-red,
        .skin-states .iradio_flat-green,
        .skin-states .iradio_flat-blue,
        .skin-states .iradio_flat-aero,
        .skin-states .iradio_flat-grey,
        .skin-states .iradio_flat-orange,
        .skin-states .iradio_flat-yellow,
        .skin-states .iradio_flat-pink,
        .skin-states .iradio_flat-purple {
            left: 35px
        }
        .skin-states .iradio_polaris {
            left: 26px
        }
        .skin-states .iradio_futurico {
            left: 31px
        }
        .colors {
            clear: both;
            padding: 24px 0 9px;
        }
        .skin-line .colors {
            padding-top: 28px
        }
        .colors strong {
            float: left;
            line-height: 20px;
            margin-right: 20px
        }
        .colors li {
            position: relative;
            float: left;
            width: 16px;
            height: 16px;
            margin: 2px 1px 0 0;
            background: #000;
            cursor: pointer;
            filter: alpha(opacity=50);
            opacity: .5;
            -webkit-transition: opacity .2s;
            -moz-transition: opacity .2s;
            -ms-transition: opacity .2s;
            -o-transition: opacity .2s;
            transition: opacity .2s;
        }
        .colors li:hover {
            filter: alpha(opacity=100);
            opacity: 1
        }
        .colors li.active {
            height: 20px;
            margin-top: 0;
            filter: alpha(opacity=75);
            opacity: .75
        }
        .colors li.red {
            background: #d54e21
        }
        .colors li.green {
            background: #78a300
        }
        .colors li.blue {
            background: #0e76a8
        }
        .colors li.aero {
            background: #9cc2cb
        }
        .colors li.grey {
            background: #73716e
        }
        .colors li.orange {
            background: #f70
        }
        .colors li.yellow {
            background: #fc0
        }
        .colors li.pink {
            background: #ff66b5
        }
        .colors li.purple {
            background: #6a5a8c
        }
        .skin-square .colors li.red {
            background: #e56c69
        }
        .skin-square .colors li.green {
            background: #1b7e5a
        }
        .skin-square .colors li.blue {
            background: #2489c5
        }
        .skin-square .colors li.aero {
            background: #9cc2cb
        }
        .skin-square .colors li.grey {
            background: #73716e
        }
        .skin-square .colors li.yellow {
            background: #fc3
        }
        .skin-square .colors li.pink {
            background: #a77a94
        }
        .skin-square .colors li.purple {
            background: #6a5a8c
        }
        .skin-square .colors li.orange {
            background: #f70
        }
        .skin-flat .colors li.red {
            background: #ec7063
        }
        .skin-flat .colors li.green {
            background: #1abc9c
        }
        .skin-flat .colors li.blue {
            background: #3498db
        }
        .skin-flat .colors li.grey {
            background: #95a5a6
        }
        .skin-flat .colors li.orange {
            background: #f39c12
        }
        .skin-flat .colors li.yellow {
            background: #f1c40f
        }
        .skin-flat .colors li.pink {
            background: #af7ac5
        }
        .skin-flat .colors li.purple {
            background: #8677a7
        }
        .skin-line .colors li.yellow {
            background: #ffc414
        }
        .skins-info {
            padding: 13px 0 57px;
            font-size: 16px;
            line-height: 22px;
            text-align: center;
        }
        .skins-info p {
            margin-bottom: 17px
        }
        .skins-info .skins-banner {
            margin: 34px 0 3px;
        }
        .skins-info .skins-banner a {
            display: block;
            width: 728px;
            height: 90px;
            margin: 0 auto;
            overflow: hidden;
            text-indent: 100%;
            white-space: nowrap;
            background: url(banner.jpg);
            -webkit-transition: opacity 0.4s ease;
            -moz-transition: opacity 0.4s ease;
            -o-transition: opacity 0.4s ease;
            transition: opacity 0.4s ease;
            border: none;
        }
        .skins-info .skins-banner a:hover {
            opacity: .8;
        }
        .skin-pre {
            padding: 43px 60px 0
        }
        .skin-usage {
            padding: 19px 60px 8px;
            list-style: decimal outside;
        }
        .skin-usage li {
            margin-bottom: 23px
        }
        .skin-usage .schemes {
            margin-bottom: -3px;
            padding: 13px 0 0 20px;
            color: #888;
        }
        .skin-usage .schemes ul {
            float: left;
            padding-right: 60px
        }
        .skin-usage .schemes li {
            margin: 0;
            padding-bottom: 3px
        }
        .usage {
            position: relative;
            margin-bottom: 80px;
            background: #fff;
        }
        .usage a {
            border-bottom-color: #ddd
        }
        .usage .self {
            border-bottom-color: #bbb
        }
        .usage .arrows {
            top: 0
        }
        .usage:hover .arrows .top,
        .usage:hover .arrows .bottom {
            left: 0
        }
        .usage h2 {
            color: #fff;
            background: #1f7f5c
        }
        .usage h4 {
            margin: 26px 0 10px;
        }
        .usage h4.indeterminate {
            margin-top: 28px
        }
        .usage p {
            margin-bottom: 5px;
        }
        .usage p.offset {
            margin-top: 10px
        }
        .usage p.callbacks-info {
            margin-bottom: 19px
        }
        .usage p.methods-info {
            margin-bottom: 10px
        }
        .usage p.methods-callback {
            margin-top: 10px
        }
        .usage p.issue-tracker {
            margin-top: 31px
        }
        .usage .markup {
            margin: 9px 0 16px
        }
        .usage .usage-inner {
            font-size: 15px;
            line-height: 23px;
            padding: 41px 60px 39px
        }
        .markup {
            margin: 10px 0 18px;
            padding: 8px 0 9px 17px;
            font: 14px/20px 'MontserratRegular', Helvetica, Arial, sans-serif;
            color: #777;
            background: #e7e5e0;
            border-left: 3px solid #d7d5cb;
        }
        .markup .comment {
            color: #999;
        }
        .markup .comment .self {
            color: #555;
        }
        .markup .comment .self:hover {
            color: #333
        }
        .skin-polaris .markup {
            background: #232830;
            border-left-color: #1f232a
        }
        .skin-futurico .markup {
            background: #25262a;
            border-left-color: #202225
        }
        .skin-polaris .markup .comment,
        .skin-futurico .markup .comment {
            color: #555
        }
        .browsers {
            margin-bottom: 74px;
        }
        .browsers h2 {
            margin-bottom: 29px;
            font-size: 24px
        }
        .browsers-inner {
            padding: 0 60px;
            font-size: 15px;
            line-height: 23px;
        }
        .browsers-inner p {
            margin-bottom: 15px
        }
        .benefits {
            position: relative;
            margin-bottom: 59px;
            color: #888;
            background: #232323;
        }
        .benefits .arrows {
            top: 0
        }
        .benefits:hover .arrows .top,
        .benefits:hover .arrows .bottom {
            left: 0
        }
        .benefits h2 {
            color: #fff;
            background: #6a5b8c
        }
        .benefits a {
            color: #888;
            border-bottom-color: #444;
        }
        .benefits a:hover {
            color: #aaa
        }
        .benefits .mark {
            color: #777;
            background: #393939
        }
        .benefits-inner {
            padding: 41px 60px 29px;
            font-size: 15px;
            line-height: 23px;
        }
        .benefits-inner p {
            margin-bottom: 15px
        }
        .benefits-inner ul {
            margin: -10px 0 15px
        }
        .leftsidebar {
            background: #f5f5f5 url('../img/arrow-down.png') no-repeat bottom right !important;
            padding: 3px 10px;
            border-bottom: 1px dotted #777;
        }
        .leftsidebar h4 a {
            color: #333 !important;
        }
        .leftsidebar .accordion-toggle::after {
            color: #ff6d6e !important;
        }
        #custom-search-input {
            padding: 0px;
            border: solid 1px #ff8c3f;
            border-radius: 5px;
            background-color: #fff;
            margin-bottom: 15px;
        }
        #custom-search-input input {
            border: 0 !important;
            box-shadow: none;
            background: none;
        }
        #custom-search-input button {
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #ff8c3f;
            padding: 0 8px 0 10px;
            border-right: solid 1px #ff8c3f;
            border-radius: 0px;
        }
        #custom-search-input button:hover {
            border: 0;
            box-shadow: none;
            border-right: solid 1px #ff8c3f;
        }
        #custom-search-input .glyphicon-search {
            font-size: 23px;
        }
        .more {
            text-align: right;
            font-size: 13px;
            color: #ff6e6f;
            direction: rtl;
            text-align: right;
            width: 100%;
            display: inline-block;
            padding-right: 25px;
        }
        .skin-jobs ul {
            direction: rtl;
            font-size: 12px;
            text-align: right;
            border-right: none;
        }
        .skin-jobs ul li {
            padding-right: 0px;
        }
        .skin-jobs ul li a {
            color: #333
        }
        .square-red {
            width: 15px;
            height: 15px;
            background: #db0d0d;
            display: inline-block;
            border-radius: 3px;
            float: right !important;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }
        .square-orange {
            width: 15px;
            height: 15px;
            background: #f04b38;
            display: inline-block;
            border-radius: 3px;
            float: right !important;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }
        .square-yellow {
            width: 15px;
            height: 15px;
            background: #db922b;
            display: inline-block;
            border-radius: 3px;
            float: right !important;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }
        .square-blue {
            width: 15px;
            height: 15px;
            background: #4287c8;
            display: inline-block;
            border-radius: 3px;
            float: right !important;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }
        .square-darkblue {
            width: 15px;
            height: 15px;
            background: #223d50;
            display: inline-block;
            border-radius: 3px;
            float: right !important;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }
        .square-green {
            width: 15px;
            height: 15px;
            background: #488623;
            display: inline-block;
            border-radius: 3px;
            float: right !important;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }
        .top-filter {
            background: #f6f7fb;
            padding: 8px;
            margin-bottom: 15px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .top-filter a {
            background: #fff;
            border: 1px solid #ddd;
            color: #333;
            display: inline-block;
            margin-left: 3px;
            margin-top: 3px;
            padding: 0 5px;
            float: right
        }
        .top-filter a:hover {
            color: #FF6D6E;
        }
        .top-filter a i {
            color: #FF6D6E;
            font-weight: normal;
            padding-right: 5px;
        }
        .top-filter .pull-left a {
            border: none;
            background: none;
            position: relative;
            top: 2px;
        }
        .top-filter .all-links {
            border: none;
            background: none;
        }
        .request-jobs {
            display: inline-block;
            padding: 0px 15px !important;
            height: 35px;
            line-height: 35px;
            text-align: center;
            color: #fff !important;
            background: #ef6203 url(../img/btn.jpg) right;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
        }
        .request-jobs:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #ff8c3f url(../img/btn.jpg) left;
            color: #fff;
        }
        .fr-div {
            float: right;
            text-align: center;
            padding: 20px;
            width: 140px;
            margin-left: 15px;
        }
        .fr-div img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
        }
        .fr-div a {
            float: right;
            text-align: center;
            display: inline-block
        }
        .row-searchjob {
            border: 1px solid #dbdbdb;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 15px;
            position: relative;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        }
        .fl-div {
            padding: 15px;
        }
        .fl-div h2 {
            color: #333;
            font-size: 15px;
            font-weight: 500;
            text-align: right;
        }
        .fl-div h6 i {
            font-size: 17px;
            color: #059b92;
        }
        .fl-div p {
            width: 100%;
        }
        .more-txt {
            position: absolute;
            left: 15px;
            bottom: 5px;
            color: #f04b38;
            text-decoration: underline
        }
        .time-jobs1 {
            border: 1px solid #DB0D0D;
            padding: 0px 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
            color: #DB0D0D;
        }
        .time-jobs2 {
            border: 1px solid #F04B38;
            padding: 0px 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
            color: #F04B38;
        }
        .time-jobs3 {
            border: 1px solid #DB922B;
            padding: 0px 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
            color: #DB922B;
        }
        .time-jobs4 {
            border: 1px solid #4287C8;
            padding: 0px 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
            color: #4287C8;
        }
        .time-jobs5 {
            border: 1px solid #223D50;
            padding: 0px 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
            color: #223D50;
        }
        .time-jobs6 {
            border: 1px solid #488623;
            padding: 0px 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
            color: #488623;
        }
        .fl-div .pull-left {
            margin-bottom: 15px;
        }
        .wrapper-grid {
            background: #f5f5f5;
            position: relative;
            text-align: right;
            padding: 10px 15px;
            -webkit-border-bottom-right-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-radius-bottomright: 5px;
            -moz-border-radius-bottomleft: 5px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        .grid-time {
            font-weight: 500;
        }
        .grid-img {
            text-align: center;
            display: inline-block;
            padding: 20px 0px;
        }
        .grid-img img {
            width: 140px;
            margin: 0px auto;
            display: inline-block;
            height: 100px;
        }
        .grid-searchjob {
            border: 1px solid #dbdbdb;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            text-align: center
        }
        .grid-like {
            position: absolute;
            left: 15px;
            top: -10px;
        }
        .wrapper-grid h2 {
            color: #333;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .wrapper-grid h4 {
            color: #666;
            margin-bottom: 5px;
        }
        .wrapper-grid h6 i {
            color: #059b92;
            font-size: 17px;
        }
        .wrapper-grid h6 {
            margin-bottom: 5px;
        }
        .wrap-grid-btn h6 {
            line-height: 30px;
        }
        .wrap-grid-btn a {
            float: left
        }
        .notrequest-jobs {
            display: inline-block;
            width: 100px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: #fff;
            background: #a1a1a1;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .notrequest-jobs:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #888;
            color: #fff;
        }
        .bg-error {
            border: 1px solid #dbdbdb;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 15px;
            position: relative;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 10px;
            background: #F2DEDE;
            direction: rtl
        }
        .bg-error p {
            margin-bottom: 0px;
            padding: 0px;
            font-size: 12px;
        }
        .bg-error a {
            position: absolute;
            left: 10px;
            top: 5px;
        }
        .bg-error a i {
            color: #999
        }
        .bg-error a i:hover {
            color: #666;
        }
        .moshkasatfard {
            margin-top: 10px;
        }
        /* Minoru */

        .input__field--minoru {
            width: 100%;
            background: #fff !important;
            box-shadow: 0px 0px 0px 2px transparent;
            color: #eca29b;
            -webkit-transition: box-shadow 0.3s;
            transition: box-shadow 0.3s;
        }
        .input__label--minoru {
            padding: 0;
            width: 100%;
            text-align: left;
        }
        .input__label--minoru::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            z-index: -1;
            width: 100%;
            box-shadow: 0px 0px 0px 0px;
            color: rgba(199, 152, 157, 0.6);
        }
        .input__field--minoru:focus {
            box-shadow: 0px 0px 0px 2px #56a748;
        }
        .input__field--minoru:focus + .input__label--minoru {
            pointer-events: none;
        }
        .input__field--minoru:focus + .input__label--minoru::after {
            -webkit-animation: anim-shadow 0.3s forwards;
            animation: anim-shadow 0.3s forwards;
        }
        @-webkit-keyframes anim-shadow {
            to {
                box-shadow: 0px 0px 100px 50px;
                opacity: 0;
            }
        }
        @keyframes anim-shadow {
            to {
                box-shadow: 0px 0px 100px 50px;
                opacity: 0;
            }
        }
        .input__label-content--minoru {
            padding: 0em;
        }
        input[type="password"] {
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #777;
            direction: rtl;
            display: block;
            font-size: 12px;
            height: 38px;
            line-height: 1.42857;
            padding: 6px 12px;
            margin-bottom: 0px;
        }
        input[type="email"] {
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #777;
            direction: ltr;
            display: block;
            font-size: 12px;
            height: 38px;
            line-height: 1.42857;
            padding: 6px 12px;
            margin-bottom: 10px;
        }
        .comment-contact {
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #777;
            direction: rtl;
            display: block;
            font-size: 12px;
            line-height: 1.42857;
            margin-bottom: 0px;
            text-align: right
        }
        .line-bottom {
            background: #ddd;
            height: 1px;
            margin: 10px 0 30px;
            width: 100%;
        }
        .content {
            margin-bottom: 15px;
        }
        .c-left-b {
            margin: 0 0 30px;
        }
        .inner-title {
            margin-bottom: 10px;
            color: #56a748;
            text-align: center;
        }
        .inner-title1 {
            margin-bottom: 10px;
            color: #56a748;
            text-align: center;
        }
        .address-contact {
            text-align: center;
            font-size: 13px;
        }
        .address-contact p {
            text-align: center;
            font-size: 13px;
        }
        .no-mar {
            margin-bottom: 0px !important;
        }
        .go-back a {
            color: #ff8c3f !important;
            font-weight: 500;
        }
        .cd-secondary-nav li a {
            height: auto !important;
        }
        .cd-secondary-nav li a img {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .cd-secondary-nav li a img:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .more-home {
            font-size: 13px;
            direction: rtl;
            font-weight: 500;
            display: inline-block;
            margin: 15px 0px;
        }
        .more-home:hover {
            color: #ff8c3f;
        }
        .center-btn {
            display: inline-block;
            padding: 0px 20px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: #fff;
            background: #ef6203 url(../img/btn.jpg) right;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
        }
        .center-btn:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #ff8c3f url(../img/btn.jpg) left;
            color: #fff;
        }
        textarea {
            resize: none;
        }
        .savabeghkari-table input[type="text"] {
            width: 100px;
            height: 30px;
            line-height: 30px;
        }
        .computerSkill-table input[type="text"] {
            width: 150px;
            height: 30px;
            line-height: 30px;
        }
        .experimental-table input[type="text"] {
            width: 150px;
            height: 30px;
            line-height: 30px;
        }
        .CPHD-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .Diploma-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .ProfesstionalTrainingRecords-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .PHD-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .AD-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .BSC-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .MSC-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 110px;
            display: inline-block
        }
        .family-table input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 130px;
            display: inline-block
        }
        .karkonantarigheash input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 130px;
            display: inline-block
        }
        .tableintroducer {
            margin: 15px 0px;
        }
        .introducer input[type="text"] {
            height: 30px;
            line-height: 30px;
            width: 130px;
            display: inline-block
        }
        .captcha {
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center
        }
        .captcha img {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        /* timeline */

        .frst-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .frst-container::after {
            content: '';
            display: table;
            clear: both
        }
        .frst-timeline {
            position: relative
        }
        .frst-right-align {
            text-align: right
        }
        .frst-timeline-block {
            position: relative;
            min-height: 16px;
            padding-left: 35px;
            padding-right: 35px
        }
        .frst-timeline-block::before {
            content: "";
            position: absolute;
            height: 100%;
            left: 0;
            top: 0
        }
        .frst-timeline-block:last-child::before {
            display: none
        }
        .frst-right-align .frst-timeline-block::before {
            right: 0;
            left: auto!important;
            margin-left: 0!important
        }
        .frst-timeline-block::after {
            content: "";
            display: table;
            clear: both
        }
        .frst-date,
        .frst-timeline-img i {
            display: block
        }
        .frst-timeline-img {
            position: absolute;
            min-width: 1px;
            min-height: 1px;
            left: 0;
            top: 0
        }
        .frst-right-align .frst-timeline-img {
            margin-left: 0!important;
            left: auto!important;
            right: 0
        }
        .frst-last-empty-item .frst-timeline-img span {
            vertical-align: top
        }
        .frst-timeline-content-inner {
            position: relative
        }
        .cssanimations .frst-timeline-content.is-hidden {
            visibility: hidden
        }
        .cssanimations .frst-timeline-content.animated {
            visibility: visible
        }
        .frst-labels span {
            display: inline-block
        }
        .frst-labels {
            padding: 20px 0
        }
        .frst-labels.frst-start-label {
            padding-top: 0!important
        }
        .frst-labels.frst-end-label {
            margin-bottom: 0!important
        }
        @media only screen and (min-width: 679px) {
            .frst-date-opposite,
            .frst-left-align.frst-date-opposite {
                margin-left: 190px
            }
            .frst-right-align.frst-date-opposite {
                margin-right: 190px;
                margin-left: 0;
                text-align: right
            }
            .frst-date-opposite.frst-alternate {
                margin: 0
            }
            .frst-timeline.frst-alternate.frst-left-align .frst-timeline-content,
            .frst-timeline.frst-alternate.frst-right-align .frst-timeline-content,
            .frst-timeline.frst-date-opposite.frst-left-align .frst-timeline-content,
            .frst-timeline.frst-date-opposite.frst-right-align .frst-timeline-content {
                width: 100%
            }
            .frst-alternate .frst-timeline-block::before {
                left: 50%
            }
            .frst-alternate .frst-timeline-img {
                left: 50%!important
            }
            .frst-alternate .frst-timeline-block.frst-even-item .frst-timeline-content {
                float: right
            }
            .frst-alternate .frst-timeline-block.frst-odd-item .frst-timeline-content {
                float: left
            }
            .frst-date-opposite .frst-date {
                position: absolute;
                top: 0;
                text-align: right
            }
            .frst-alternate .frst-timeline-block.frst-odd-item .frst-timeline-content,
            .frst-alternate.frst-date-opposite .frst-timeline-block.frst-even-item .frst-date,
            .frst-date-opposite.frst-left-align .frst-date,
            .frst-right-align {
                text-align: right
            }
            .frst-alternate.frst-date-opposite .frst-timeline-block.frst-odd-item .frst-timeline-content .frst-date,
            .frst-date-opposite.frst-right-align .frst-date {
                text-align: left
            }
            .frst-alternate .frst-timeline-label-block {
                text-align: center
            }
            .frst-alternate .frst-timeline-label-block .frst-labels span {
                left: 0;
                right: 0
            }
        }
        @media only screen and (max-width: 678px) {
            .frst-timeline {
                margin-left: 20px
            }
            .frst-timeline.frst-responsive-right,
            .frst-timeline.frst-right-align {
                margin-right: 20px;
                margin-left: 0
            }
            .frst-responsive-right .frst-timeline-block::before,
            .frst-responsive-right .frst-timeline-img {
                margin-left: 0!important;
                left: auto!important;
                right: 0
            }
            .frst-responsive-right {
                text-align: right
            }
            .frst-date {
                margin-bottom: 10px
            }
        }
        .frst-timeline-style-18 {
            color: #000;
        }
        .frst-timeline-style-18 .frst-timeline-block::before {
            width: 2px;
            background: rgba(0, 0, 0, 0);
            margin-left: -1px;
            background: #17a0f0;
        }
        .frst-timeline-style-18.frst-right-align .frst-timeline-block::before {
            margin-right: -1px;
        }
        .frst-timeline-block {
            padding-bottom: 30px;
            padding-left: 45px;
            padding-right: 45px;
        }
        .frst-timeline-style-18 .frst-timeline-img {
            padding: 0;
            margin-left: -28px;
            top: 5px;
            /*--- Box shadow value --*/

            width: 56px;
            height: 56px;
            color: #d5dbdb;
            text-align: center;
            font-size: 28px;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }
        .frst-timeline-style-18 .frst-timeline-img span {
            display: inline-block;
            margin: auto;
            padding: 10px;
            min-height: 16px;
            min-width: 16px;
            background: #ffffff;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            vertical-align: middle;
            box-shadow: 0 0 0 2px #d5dbdb;
            -webkit-box-shadow: 0 0 0 2px #d5dbdb;
            height: 50px;
            width: 50px;
        }
        .frst-timeline-style-18 .frst-timeline-img i {
            display: block;
            position: relative;
            transform: translateY(-50%);
            top: 15px;
            left: .5px;
        }
        .frst-timeline-style-18.frst-right-align .frst-timeline-img {
            margin-right: -28px;
        }
        .frst-timeline-style-18 .frst-timeline-content {
            color: #6f6f6f;
        }
        .frst-timeline-style-18 .frst-date {
            color: #9c9c9c;
            margin-bottom: 10px;
            display: block;
        }
        .frst-timeline-style-18 .frst-date i {
            margin-right: 5px;
            position: relative;
            top: 1px;
        }
        .frst-timeline-style-18 h2 {
            margin: 0 0 5px;
            font-weight: 800;
            color: #6f6f6f;
            font-size: 16px;
        }
        .frst-timeline-style-18 p {
            margin: 0;
        }
        .frst-timeline-style-18 .frst-timeline-label-block {
            padding-top: 0;
        }
        .frst-timeline-style-18 .frst-labels {
            padding: 50px 0;
        }
        .frst-timeline-style-18 .frst-labels.frst-start-label {
            padding-top: 0;
        }
        .frst-timeline-style-18 .frst-labels.frst-end-label {
            padding-bottom: 0;
        }
        .frst-timeline-style-18 .frst-labels span {
            position: relative;
            background: #ef6203;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            vertical-align: top;
            color: #ffffff;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #ef6203;
            width: 60px;
            height: 60px;
            padding: 15px 5px;
            margin-left: -45px;
            left: -35px;
        }
        .frst-timeline-style-18.frst-alternate .frst-timeline-label-block .frst-labels span {
            margin: 0;
        }
        .frst-timeline-style-18.frst-right-align .frst-labels span {
            left: auto;
            right: -35px;
            margin-left: 0;
            margin-right: -45px;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner {
            padding: 15px;
            position: relative;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            background: #ffffff;
            border: 2px solid #D5DBDB;
            cursor: pointer;
            min-height: 140px;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }
        .frst-timeline-style-18 .frst-timeline-block.active .frst-timeline-content-inner {
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            border-color: #56a748;
        }
        .frst-timeline-style-18 .frst-timeline-block.active .frst-timeline-content-inner:before {
            border-right-color: #56a748 !important;
        }
        .frst-timeline-style-18.frst-alternate .frst-timeline-block.active.frst-odd-item .frst-timeline-content-inner::before {
            border-left-color: #56a748 !important;
        }
        .frst-timeline-style-18 .frst-timeline-block.active .frst-timeline-img {
            color: #56a748;
        }
        .frst-timeline-style-18 .frst-timeline-block.active .frst-timeline-img span {
            box-shadow: 0 0 0 2px #56a748;
            -webkit-box-shadow: 0 0 0 2px #56a748;
        }


        .frst-timeline-style-18 .frst-timeline-block:hover .frst-timeline-content-inner {
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            border-color: #56a748;
        }
        .frst-timeline-style-18 .frst-timeline-block:hover .frst-timeline-content-inner:before {
            border-right-color: #56a748 !important;
        }
        .frst-timeline-style-18 .frst-timeline-block:hover .frst-timeline-img {
            color: #56a748;
        }
        .frst-timeline-style-18 .frst-timeline-block:hover .frst-timeline-img span {
            box-shadow: 0 0 0 2px #56a748;
            -webkit-box-shadow: 0 0 0 2px #56a748;
        }
        .frst-timeline-style-18.frst-alternate .frst-timeline-block:hover.frst-odd-item .frst-timeline-content-inner::before {
            border-left-color: #56a748 !important;
        }


        .frst-timeline-style-18 .frst-timeline-content-inner .media-section {
            width: 100%;
            max-height: 350px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner .media-section iframe {
            max-width: 100%;
            max-height: 350px;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner .text-content {
            text-align: right;
            position: relative;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner img {
            object-fit: cover;
            margin-bottom: 10px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner img:hover {
            opacity: 0.8;
            filter: Alpha(opacity=80);
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner::before,
        .frst-timeline-style-18 .frst-timeline-content-inner::after {
            content: "";
            border-style: solid;
            border-color: transparent;
            position: absolute;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner::before {
            border-width: 10px 11px 10px 0;
            border-right-color: #D5DBDB;
            left: -12px;
            top: 18px;
        }
        .frst-timeline-style-18 .frst-timeline-content-inner::after {
            border-width: 8px 9px 8px 0;
            border-right-color: #ffffff;
            left: -9px;
            top: 20px;
        }
        .frst-timeline-style-18.frst-right-align .frst-timeline-content-inner::before {
            border-width: 10px 0 10px 11px;
            border-left-color: #D5DBDB;
            left: auto;
            right: -12px;
        }
        .frst-timeline-style-18.frst-right-align .frst-timeline-content-inner::after {
            border-width: 8px 0 8px 9px;
            border-left-color: #ffffff;
            right: -9px;
            left: auto;
        }
        /*---------- Responsive part ------------*/

        @media only screen and (min-width: 679px) {
            .frst-date-opposite {
                margin-left: 203px;
            }
            .frst-left-align.frst-date-opposite {
                margin-left: 203px;
            }
            .frst-right-align.frst-date-opposite {
                margin-right: 203px;
                margin-left: 0;
            }
            .frst-timeline-style-18.frst-alternate .frst-timeline-content,
            .frst-timeline-style-18.frst-date-opposite .frst-timeline-content {
                width: calc(50% - 44px);
            }
            .frst-timeline-style-18.frst-date-opposite .frst-date {
                left: -248px;
                line-height: 56px;
                width: 160px;
            }
            .frst-timeline-style-18.frst-date-opposite.frst-right-align .frst-date,
            .frst-timeline-style-18.frst-date-opposite.frst-alternate .frst-timeline-block.frst-odd-item .frst-date {
                right: -248px;
                left: auto;
                text-align: left;
            }
            .frst-timeline-style-18.frst-right-align .frst-date {
                left: auto;
                right: 0;
            }
            /*--------- news-------*/

            .frst-timeline-style-18.frst-alternate .frst-odd-item .frst-timeline-content-inner::before {
                border-width: 10px 0 10px 11px;
                border-left-color: #d5dbdb;
                left: auto;
                right: -12px;
            }
            .frst-timeline-style-18.frst-alternate .frst-odd-item .frst-timeline-content-inner::after {
                border-width: 8px 0 8px 9px;
                border-left-color: #ffffff;
                right: -9px;
                left: auto;
                top: 20px;
            }
        }
        @media only screen and (max-width: 1200px) {
            .frst-timeline-style-18 {
                margin-left: 45px;
            }
            .frst-timeline-style-18.frst-right-align {
                margin-left: 0;
                margin-right: 45px;
            }
        }
        @media only screen and (max-width: 678px) {
            .frst-timeline-style-18.frst-responsive-right .frst-labels span {
                left: auto;
                right: -47px
            }
            .frst-timeline-style-18.frst-responsive-right .frst-timeline-block::before {
                margin-right: -1px;
            }
            .frst-timeline-style-18.frst-responsive-right .frst-timeline-img {
                margin-right: -28px;
            }
            .frst-timeline-style-18.frst-alternate .frst-timeline-label-block .frst-labels span {
                margin-left: -45px;
            }
            .frst-timeline-style-18.frst-responsive-right .frst-labels span,
            .frst-timeline-style-18.frst-alternate.frst-responsive-right .frst-labels span {
                right: -35px;
                margin-right: -45px;
                left: auto;
                margin-left: 0;
            }
            .frst-timeline-style-18.frst-responsive-right {
                margin-left: 0;
                margin-right: 45px;
            }
            /*--------- news-------*/

            .frst-timeline-style-18.frst-responsive-right .frst-timeline-content-inner::before {
                border-width: 10px 0 10px 11px;
                border-left-color: #D5DBDB;
                left: auto;
                right: -11px;
            }
            .frst-timeline-style-18.frst-responsive-right .frst-timeline-content-inner::after {
                border-width: 8px 0 8px 9px;
                border-left-color: #D5DBDB;
                right: -8px;
                left: auto;
            }
        }
        .rialnamad {
            float: left;
            position: relative;
            right: 5px;
            top: 5px;
        }
        .bgdark {
            background: url(../img/bgdark.png) repeat;
            position: absolute;
            top: 0px;
            right: 0px;
            left: 0px;
            z-index: 99;
            height: 140px;
        }
        .bgdark1 {
            margin-bottom: 30px;
        }
        .fr-img-curve {
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            float: right;
            width: 130px;
            height: 130px;
            margin-top: 60px;
            margin-right: 50px;
            border: 1px solid #ccc;
            padding: 3px;
            background: #fff;
            margin-left: 20px;
        }
        .img-curve {
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            width: 130px;
            height: 130px;
            border: 1px solid #ccc;
            padding: 3px;
            background: #fff;
            margin-top: 30px;
        }
        .xs-header h2 {
            color: #555 !important;
            text-align: center !important;
            margin-top: 20px !important;
            font-size: 18px !important;
            font-weight: 500;
        }
        .xs-header h3 {
            color: #999 !important;
            text-align: center !important;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .relative-wrapper {
            position: relative;
            margin-bottom: 90px;
        }
        .bgdark h2 {
            color: #fff;
            text-align: right;
            margin-top: 70px;
            font-size: 21px;
            font-weight: 500;
            direction: rtl
        }
        .bgdark h3 {
            color: #999;
            text-align: right;
            font-size: 15px;
            font-weight: 500;
        }
        .fl-img-logo {
            float: left;
            left: 25px;
            position: absolute;
            top: 40px
        }
        .p-img-logo {
            float: left;
            left: 0px;
            position: absolute;
            top: 40px;
            right: 0px;
            height: 70px;
            width: 200px;
            margin: 0px auto;
        }
        .pdf-title {
            font-weight: 700;
            font-size: 13px;
            text-align: right;
            background: #fff;
            height: 40px;
            line-height: 40px;
            margin-bottom: 15px;
            border-bottom: 1px solid #999;
            padding-right: 15px;
        }
        .wrap-pdf {
            border-right: 1px solid #999;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        .wrap-pdf p {
            padding: 2px 15px;
        }
        .wrap-pdf strong {
            font-weight: 500;
            font-size: 13px;
        }
        .wrap-pdf-inner p {
            color: #555
        }
        .wrap-pdf-inner {
            margin-top: 5px;
            background: #f3f3f3;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            margin-bottom: 5px;
        }
        .exph {
            padding: 15px;
            font-size: 13px;
            font-weight: 700;
            border-top: 1px solid #999;
            border-bottom: 1px solid #999;
            margin-top: 5px;
            padding: 5px 15px;
            margin-bottom: 5px;
        }
        .hr-pdf {
            border-color: #999;
            background: #999;
            height: 1px;
            width: 100%;
            margin: 10px 0px;
        }
        .blockquote {
            border: 1px solid #ddd;
            background: #f3f3f3;
            float: right;
            padding: 10px;
            width: 250px;
            text-align: justify;
            font-size: 14px;
            margin-left: 20px;
            margin-top: 20px;
            margin-bottom: 15px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .img-page {
            margin-bottom: 15px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .fl-img-page {
            width: 300px;
            margin-bottom: 10px;
            margin-right: 20px;
            float: left;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .fr-img-page {
            width: 300px;
            margin-bottom: 10px;
            margin-left: 20px;
            float: right;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .request-job-btn {
            padding: 5px 20px;
            color: #fff;
            background: #17a0f0 url(../img/btn2.jpg) right;
            font-size: 14px;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            border: none;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            float: left;
        }
        .request-job-btn:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #17a0f0 url(../img/btn2.jpg) left;
        }
        .active-jobs {
            color: #17a0f0 !important;
            font-size: 13px;
            font-weight: 500;
            padding-right: 10px;
        }

        .inner-content-result {
            direction: rtl;
            text-align: right;
            margin-bottom: 30px;
        }
        .inner-content-result ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .inner-content-result ul li {
            background: #f6f6f6;
            border-bottom: 1px solid #ddd;
            direction: rtl;
            padding: 5px 15px;
            text-align: right;
        }
        .inner-content-result ul li a {
            color: #000101;
            direction: rtl;
            line-height: 25px;
            text-align: right;
        }
        .inner-content-result ul li:nth-child(2n+1) {
            background: #f9f9f9;
        }
        .inner-content-result ul li a:hover {
            color: #c4161c;
        }
        .date-searchnews {
            color: #c4161c;
            padding-right: 5px;
            font-size: 11px;
            line-height: 28px;
        }
        .bolet-news {
            color: #c4161c;
            font-size: 5px;
            line-height: 25px;
            margin-left: 5px;
        }
        .title-search {
            background: #f5f5f5 url('../img/arrow-down.png') no-repeat bottom right;
            border-bottom: 1px dotted #777;
            padding: 3px 10px;
        }
        .title-search h3 {
            font-weight: 500;
        }
        .c-mar {
            margin-right: 75px;
        }
        .pointer-hand {
            cursor: pointer;
        }
        .edit-resume {
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background: #ef6203 url(../img/btn.jpg) right;
            color: #fff;
            text-align: center;
            padding: 2px 10px;
            font-size: 14px;
            display: inline-block;
            border: none;
            top: -4px;
            position: relative;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .edit-resume:hover {
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            color: #fff;
            background: #ff8c3f url(../img/btn.jpg) left;
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
            display: inline-block;
            font-weight: 500;
        }
        blockquote {
            background: #f5f5f5;
            border-right: 4px solid #ff9934;
            float: right;
            font-size: 14px;
            font-weight: 500;
            margin: 15px 0 0 20px;
            padding: 20px;
            text-align: justify;
            width: 300px;
        }
        button:active {
            outline: none;
            border: none;
        }
        .employ-container {
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            max-width: 350px;
            overflow: hidden;
            padding: 30px;
            width: 100%;
        }
        .employ-container h2 {
            color: #000;
            direction: rtl;
            font-size: 14px;
            font-weight: 700;
            margin: 0;
            text-align: right;
        }
        .employ-container p {
            color: #000;
            direction: rtl;
            font-size: 13px;
            font-weight: 500;
            margin: 0;
            text-align: justify;
        }
        .modalcir {
            cursor: pointer;
        }
        .title-jobs-index {
            background: none !important;
            border-radius: 0 !important;
            color: #333 !important;
            display: inline-block;
            height: 33px;
            line-height: 30px;
            overflow: hidden;
            text-align: center;
            width: auto !important;
        }
        .rememberme {
            direction: rtl;
            float: right;
            font-size: 13px;
            height: 40px;
            line-height: 40px;
            text-align: right;
            width: 215px;
        }
        .seprator {
            background: #ccc;
            height: 20px;
            padding: 0;
            position: relative;
            top: 30px;
            width: 1px;
            margin-left: 5px !important;
        }
        .active-topmenu {
            color: #ff8c3f !important;
        }
        /** initial setup **/

        .nano {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .nano > .nano-content {
            position: absolute;
            overflow: scroll;
            overflow-x: hidden;
            top: 0;
            left: -15px;
            bottom: 0;
            right: 15px;
            padding: 0px 15px;
        }
        .nano > .nano-content:focus {
            outline: thin dotted;
        }
        .nano > .nano-content::-webkit-scrollbar {
            display: none;
        }
        .has-scrollbar > .nano-content::-webkit-scrollbar {
            display: block;
        }
        .nano > .nano-pane {
            background: rgba(0, 0, 0, .25);
            position: absolute;
            width: 10px;
            left: 0;
            top: 0;
            bottom: 0;
            visibility: hidden\9;
            /* Target only IE7 and IE8 with this hack */

            opacity: .01;
            -webkit-transition: .2s;
            -moz-transition: .2s;
            -o-transition: .2s;
            transition: .2s;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
        .nano > .nano-pane > .nano-slider {
            background: #444;
            background: rgba(0, 0, 0, .5);
            position: relative;
            margin: 0 1px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
        }
        .nano:hover > .nano-pane,
        .nano-pane.active,
        .nano-pane.flashed {
            visibility: visible\9;
            /* Target only IE7 and IE8 with this hack */

            opacity: 0.99;
        }
        .situation {
            text-align: center !important;
            display: inline-block;
        }
        .loading {
            background: #FFF;
            height: 100%;
            position: absolute;
            width: 100%;
            z-index: 9999;
        }
        .loading-img {
            width: 350px;
            height: 251px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -125px;
            margin-left: -175px;
        }
        .loading-logo {
            width: 128px;
            height: 55px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -120px;
            margin-left: -64px;
        }
        .cd-main-relative {
            position: relative !important;
            transform: none !important;
            transition: none !important;
            top:0px;


        }
        .blog-title-inner {
            position: relative !important;
            top: 0px;
        }
        .bs-wizard {
            margin-top: 40px;
        }
        /*Form Wizard*/

        .bs-wizard {
            border-bottom: solid 1px #e0e0e0;
            padding: 0 0 10px 0;
        }
        .bs-wizard > .bs-wizard-step {
            padding: 0;
            position: relative;
            width: 20%;
            float: right;
        }
        .bs-wizard > .bs-wizard-step + .bs-wizard-step {} .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {
                                                              color: #595959;
                                                              font-size: 12px;
                                                              margin-bottom: 5px;
                                                              font-weight: 500
                                                          }
        .bs-wizard > .bs-wizard-step .bs-wizard-info {
            color: #999;
            font-size: 14px;
        }
        .bs-wizard > .bs-wizard-step > .bs-wizard-dot {
            position: absolute;
            width: 30px;
            height: 30px;
            display: block;
            background: #ff8c3f;
            top: 45px;
            right: 50%;
            margin-top: -15px;
            margin-right: -15px;
            border-radius: 50%;
        }
        .bs-wizard > .bs-wizard-step > .bs-wizard-notcomplete {
            position: absolute;
            width: 30px;
            height: 30px;
            display: block;
            background: #fff;
            border:2px solid #FF8C3F;
            top: 45px;
            right: 50%;
            margin-top: -15px;
            margin-right: -15px;
            border-radius: 50%;
        }
        .bs-wizard > .bs-wizard-step > .bs-wizard-notcomplete i {
            color: #FF8C3F;
            font-size: 16px;
            position: relative;
            right: 4px;
            top:4px;
        }
        .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {
            content: ' ';
            width: 14px;
            height: 14px;
            border-radius: 50px;
            position: absolute;
            top: 8px;
            right: 8px;
        }
        .bs-wizard > .bs-wizard-step > .bs-wizard-dot i {
            color: #fff;
            font-size: 16px;
            position: relative;
            right: 6px;
            top: 6px;
        }
        .bs-wizard > .bs-wizard-step > .progress {
            position: relative;
            border-radius: 0px;
            height: 8px;
            box-shadow: none;
            margin: 20px 0;
            background: #ddd;
        }
        .bs-wizard > .bs-wizard-step > .progress > .progress-bar {
            width: 0px;
            box-shadow: none;
            background: #ff8c3f;
        }
        .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {
            width: 100%;
        }
        .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {
            width: 50%;
        }
        .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {
            width: 0%;
        }
        .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {
            width: 100%;
        }
        .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {
            background-color: #f5f5f5;
        }
        .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {
            opacity: 0;
        }
        .bs-wizard > .bs-wizard-step:first-child > .progress {
            right: 50%;
            width: 50%;
        }
        .bs-wizard > .bs-wizard-step:last-child > .progress {
            width: 50%;
        }
        .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot {
            pointer-events: none;
        }
        .pd-80{
            padding-top: 60px;
        }
        .info-man{
            float: left;
            color:#ff8c3f;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            padding: 4px 0px;
        }
        .has-error{
            position: relative
        }
        .avatar{
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        .wrapper-books {
            border-bottom: 1px solid #ddd;
            padding: 20px 0px 0px 0px !important;
        }
        .wrapper-books:first-child {
            padding: 0px 0px 0px 0px !important;
        }
        .wrapper-books:last-child{
            border-bottom: none;
        }
        .books img{
            float: right;
            position: relative;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-left: 20px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: alpha(opacity=100);
            -moz-opacity: 1;
            -khtml-opacity: 1;
            opacity: 1;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            margin-bottom: 20px;
        }
        .books img:hover{
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
            filter: alpha(opacity=80);
            -moz-opacity: .8;
            -khtml-opacity: .8;
            opacity: .8;
        }
        .name-book{
            text-align: right;
            direction: rtl;
            font-size: 12px;

        }

        .book-detail-index{
            background: #eee;
            border: 1px dotted #ddd;
            padding: 30px 15px;
            font-size: 12px; margin: 15px 0px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .book-detail-index:before {
            width: 0;
            height: 0;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;

            border-left: 10px solid #eee;
            position: absolute;
            right:6px;
            top:30px;
        }
        .n-books{
            font-size: 15px;
            font-weight: 500;
            color:#333;
            text-decoration: none

        }
        .name-book p{
            color:#666
        }
        .name-book p span{
            font-size: 12px;
            font-weight: 500;
            padding-right: 5px;
            display: inline-block;
            color:#333
        }
        .more-books{
            color:#ff8c3f;
            text-decoration: underline;
            position: absolute;
            bottom: 15px;
            font-size: 12px;
            font-weight: 500;
            direction: rtl
        }
        .cd-primary-nav .cd-nav-gallery li:last-child {
            margin: 4% 0% 0 0;
        }

        .title-video-page{
            text-align: right;
            direction: rtl;
            padding: 20px 0px 0px 0px;
        }
        .img-video {
            height: 30px !important;
            width: 30px !important;
            margin: 0px auto
        }
        .see-more{
            font-size: 13px;
            visibility: visible;
            float: left;
            animation-name: fadeIn;
            display: inline-block;
            color:#666;
            line-height: 28px;
        }
        .mt-30{
            margin-top: 20px;
        }
        .videotag{
            margin-bottom: 15px;
        }
        .row-videos {
            position: relative;
            direction: rtl;
            font-size: 13px;
            text-align: right;
            margin-bottom: 20px;
        }
        .row-videos h2 a {
            color: #333;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
            text-decoration: none;
        }
        .row-videos a {
            color: #ff9a30;
            display: inline-block;
            font-size: 12px;
            font-weight: 500;
            text-decoration: underline;
        }
        .save-re {
            background: #56a748 !important;
            border-radius: 30px;
            color: #fff;
            display: inline-block;
            height: 33px;
            line-height: 25px;
            overflow: hidden;
            text-align: center;
            transition: all 0.4s ease 0s;
            width: 100px;
        }
        .save-re:hover {
            background: #56a748;
            color: #fff;
        }
        .bg-partners{
            background: #fff;
            padding: 20px;
            border:1px solid #eee;
            border-bottom: 2px solid #ddd;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            direction: rtl;
            text-align: justify;
            font-size: 13px;
            margin-bottom: 15px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);

        }
        .bg-partners img{
            background: #ddd;
            border-radius: 50%;
            float: right;
            height: 70px;
            margin: 7px;
            width: 70px !important;
        }
        .wrapper-partners h4{
            font-size: 13px;
            font-weight: 500;
            color:#e44142;
        }
        .title-partners{
            padding-right: 100px;
        }
        .title-partners h5{
            font-size: 13px;
            font-weight: 500;
            color:#17a0f0;
        }
        .title-partners h6{
            font-size: 13px;
            font-weight: 500;
            color:#999
        }
        .title-partners p{
            border-top:1px solid #ddd;
            padding: 15px 0px;
        }
        .wrapper-partners{
            float: right
        }
        .wrapper-partners i{
            float: left;
            color:#ddd;
            font-size: 30px;
            position: relative;
            top:5px;
        }
        .partners .owl-dots {
            display: none;
        }
        .partners .owl-nav .owl-prev {
            background:#ef6203  url("../img/back.png") no-repeat center;
            cursor: pointer;
            display: inline-block;
            height: 35px;
            width: 35px;
            margin-bottom: 15px;
        }
        .partners .owl-nav .owl-next {
            background:#ef6203  url("../img/next.png") no-repeat center;
            cursor: pointer;
            display: inline-block;
            height: 35px;
            width: 35px;
            margin-bottom: 15px;
        }
        .partners .owl-nav .owl-prev:hover {
            background:#999 url("../img/back.png") no-repeat center;
        }
        .partners .owl-nav .owl-next:hover {
            background:#999 url("../img/next.png") no-repeat center;
        }
        .jq-ry-container{
            padding: 0px !important;
        }
        /*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
        html {
            font-family: sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        main,
        menu,
        nav,
        section,
        summary {
            display: block;
        }
        audio,
        canvas,
        progress,
        video {
            display: inline-block;
            vertical-align: baseline;
        }
        audio:not([controls]) {
            display: none;
            height: 0;
        }
        [hidden],
        template {
            display: none;
        }
        a {
            background-color: transparent;
        }
        a:active,
        a:hover {
            outline: 0;
        }
        abbr[title] {
            border-bottom: 1px dotted;
        }
        b,
        strong {
            font-weight: bold;
        }
        dfn {
            font-style: italic;
        }
        h1 {
            margin: .67em 0;
            font-size: 2em;
        }
        mark {
            color: #000;
            background: #ff0;
        }
        small {
            font-size: 80%;
        }
        sub,
        sup {
            position: relative;
            font-size: 75%;
            line-height: 0;
            vertical-align: baseline;
        }
        sup {
            top: -.5em;
        }
        sub {
            bottom: -.25em;
        }
        img {
            border: 0;
        }
        svg:not(:root) {
            overflow: hidden;
        }
        figure {
            margin: 1em 40px;
        }
        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }
        pre {
            overflow: auto;
        }
        code,
        kbd,
        pre,
        samp {
            font-family: monospace, monospace;
            font-size: 1em;
        }
        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font: inherit;
            color: inherit;
        }
        button {
            overflow: visible;
        }
        button,
        select {
            text-transform: none;
        }
        button,
        html input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            -webkit-appearance: button;
            cursor: pointer;
        }
        button[disabled],
        html input[disabled] {
            cursor: default;
        }
        button::-moz-focus-inner,
        input::-moz-focus-inner {
            padding: 0;
            border: 0;
        }
        input {
            line-height: normal;
        }
        input[type="checkbox"],
        input[type="radio"] {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            height: auto;
        }
        input[type="search"] {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            -webkit-appearance: textfield;
        }
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
        }
        fieldset {
            padding: .35em .625em .75em;
            margin: 0 2px;
            border: 1px solid #c0c0c0;
        }
        legend {
            padding: 0;
            border: 0;
        }
        textarea {
            overflow: auto;
        }
        optgroup {
            font-weight: bold;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }
        td,
        th {
            padding: 0;
        }
        /*! Source: https://github.com/h5bp/html5-boilerplate/blob/master/src/css/main.css */
        @media print {
            *,
            *:before,
            *:after {
                color: #000 !important;
                text-shadow: none !important;
                background: transparent !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
            }
            a,
            a:visited {
                text-decoration: underline;
            }
            a[href]:after {
                content: " (" attr(href) ")";
            }
            abbr[title]:after {
                content: " (" attr(title) ")";
            }
            a[href^="#"]:after,
            a[href^="javascript:"]:after {
                content: "";
            }
            pre,
            blockquote {
                border: 1px solid #999;

                page-break-inside: avoid;
            }
            thead {
                display: table-header-group;
            }
            tr,
            img {
                page-break-inside: avoid;
            }
            img {
                max-width: 100% !important;
            }
            p,
            h2,
            h3 {
                orphans: 3;
                widows: 3;
            }
            h2,
            h3 {
                page-break-after: avoid;
            }
            .navbar {
                display: none;
            }
            .btn > .caret,
            .dropup > .btn > .caret {
                border-top-color: #000 !important;
            }
            .label {
                border: 1px solid #000;
            }
            .table {
                border-collapse: collapse !important;
            }
            .table td,
            .table th {
                background-color: #fff !important;
            }
            .table-bordered th,
            .table-bordered td {
                border: 1px solid #ddd !important;
            }
        }
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        html {
            font-size: 10px;

            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        input,
        button,
        select,
        textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }
        a {
            color: #444;
            text-decoration: none;
        }
        a:hover,
        a:focus {
            color: #333;
            text-decoration: none;
        }
        a:focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }
        figure {
            margin: 0;
        }
        img {
            vertical-align: middle;
        }
        .img-responsive,
        .thumbnail > img,
        .thumbnail a > img,
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            display: block;
            max-width: 100%;
            height: auto;
        }
        .img-rounded {
            border-radius: 6px;
        }
        .img-thumbnail {
            display: inline-block;
            max-width: 100%;
            height: auto;
            padding: 4px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }
        .img-circle {
            border-radius: 50%;
        }
        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eee;
        }
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }
        .sr-only-focusable:active,
        .sr-only-focusable:focus {
            position: static;
            width: auto;
            height: auto;
            margin: 0;
            overflow: visible;
            clip: auto;
        }
        [role="button"] {
            cursor: pointer;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit;
        }
        h1 small,
        h2 small,
        h3 small,
        h4 small,
        h5 small,
        h6 small,
        .h1 small,
        .h2 small,
        .h3 small,
        .h4 small,
        .h5 small,
        .h6 small,
        h1 .small,
        h2 .small,
        h3 .small,
        h4 .small,
        h5 .small,
        h6 .small,
        .h1 .small,
        .h2 .small,
        .h3 .small,
        .h4 .small,
        .h5 .small,
        .h6 .small {
            font-weight: normal;
            line-height: 1;
            color: #777;
        }
        h1,
        .h1,
        h2,
        .h2,
        h3,
        .h3 {
            margin-top: 20px;
            margin-bottom: 10px;
        }
        h1 small,
        .h1 small,
        h2 small,
        .h2 small,
        h3 small,
        .h3 small,
        h1 .small,
        .h1 .small,
        h2 .small,
        .h2 .small,
        h3 .small,
        .h3 .small {
            font-size: 65%;
        }
        h4,
        .h4,
        h5,
        .h5,
        h6,
        .h6 {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        h4 small,
        .h4 small,
        h5 small,
        .h5 small,
        h6 small,
        .h6 small,
        h4 .small,
        .h4 .small,
        h5 .small,
        .h5 .small,
        h6 .small,
        .h6 .small {
            font-size: 75%;
        }
        h1,
        .h1 {
            font-size: 36px;
        }
        h2,
        .h2 {
            font-size: 30px;
        }
        h3,
        .h3 {
            font-size: 24px;
        }
        h4,
        .h4 {
            font-size: 18px;
        }
        h5,
        .h5 {
            font-size: 14px;
        }
        h6,
        .h6 {
            font-size: 12px;
        }
        p {
            margin: 0 0 10px;
        }
        .lead {
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 300;
            line-height: 1.4;
        }
        @media (min-width: 768px) {
            .lead {
                font-size: 21px;
            }
        }
        small,
        .small {
            font-size: 85%;
        }
        mark,
        .mark {
            padding: .2em;
            background-color: #fcf8e3;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-justify {
            text-align: justify;
        }
        .text-nowrap {
            white-space: nowrap;
        }
        .text-lowercase {
            text-transform: lowercase;
        }
        .text-uppercase {
            text-transform: uppercase;
        }
        .text-capitalize {
            text-transform: capitalize;
        }
        .text-muted {
            color: #777;
        }
        .text-primary {
            color: #337ab7;
        }
        a.text-primary:hover,
        a.text-primary:focus {
            color: #286090;
        }
        .text-success {
            color: #3c763d;
        }
        a.text-success:hover,
        a.text-success:focus {
            color: #2b542c;
        }
        .text-info {
            color: #31708f;
        }
        a.text-info:hover,
        a.text-info:focus {
            color: #245269;
        }
        .text-warning {
            color: #8a6d3b;
        }
        a.text-warning:hover,
        a.text-warning:focus {
            color: #66512c;
        }
        .text-danger {
            color: #a94442;
        }
        a.text-danger:hover,
        a.text-danger:focus {
            color: #843534;
        }
        .bg-primary {
            color: #fff;
            background-color: #337ab7;
        }
        a.bg-primary:hover,
        a.bg-primary:focus {
            background-color: #286090;
        }
        .bg-success {
            background-color: #dff0d8;
        }
        a.bg-success:hover,
        a.bg-success:focus {
            background-color: #c1e2b3;
        }
        .bg-info {
            background-color: #d9edf7;
        }
        a.bg-info:hover,
        a.bg-info:focus {
            background-color: #afd9ee;
        }
        .bg-warning {
            background-color: #fcf8e3;
        }
        a.bg-warning:hover,
        a.bg-warning:focus {
            background-color: #f7ecb5;
        }
        .bg-danger {
            background-color: #f2dede;
        }
        a.bg-danger:hover,
        a.bg-danger:focus {
            background-color: #e4b9b9;
        }
        .page-header {
            padding-bottom: 9px;
            margin: 40px 0 20px;
            border-bottom: 1px solid #eee;
        }
        ul,
        ol {
            margin-top: 0;
            margin-bottom: 10px;
        }
        ul ul,
        ol ul,
        ul ol,
        ol ol {
            margin-bottom: 0;
        }
        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }
        .list-inline {
            padding-left: 0;
            margin-left: -5px;
            list-style: none;
        }
        .list-inline > li {
            display: inline-block;
            padding-right: 5px;
            padding-left: 5px;
        }
        dl {
            margin-top: 0;
            margin-bottom: 20px;
        }
        dt,
        dd {
            line-height: 1.42857143;
        }
        dt {
            font-weight: bold;
        }
        dd {
            margin-left: 0;
        }
        @media (min-width: 768px) {
            .dl-horizontal dt {
                float: left;
                width: 160px;
                overflow: hidden;
                clear: left;
                text-align: right;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .dl-horizontal dd {
                margin-left: 180px;
            }
        }
        abbr[title],
        abbr[data-original-title] {
            cursor: help;
            border-bottom: 1px dotted #777;
        }
        .initialism {
            font-size: 90%;
            text-transform: uppercase;
        }
        blockquote {
            padding: 10px 20px;
            margin: 0 0 20px;
            font-size: 17.5px;
            border-left: 5px solid #eee;
        }
        blockquote p:last-child,
        blockquote ul:last-child,
        blockquote ol:last-child {
            margin-bottom: 0;
        }
        blockquote footer,
        blockquote small,
        blockquote .small {
            display: block;
            font-size: 80%;
            line-height: 1.42857143;
            color: #777;
        }
        blockquote footer:before,
        blockquote small:before,
        blockquote .small:before {
            content: '\2014 \00A0';
        }
        .blockquote-reverse,
        blockquote.pull-right {
            padding-right: 15px;
            padding-left: 0;
            text-align: right;
            border-right: 5px solid #eee;
            border-left: 0;
        }
        .blockquote-reverse footer:before,
        blockquote.pull-right footer:before,
        .blockquote-reverse small:before,
        blockquote.pull-right small:before,
        .blockquote-reverse .small:before,
        blockquote.pull-right .small:before {
            content: '';
        }
        .blockquote-reverse footer:after,
        blockquote.pull-right footer:after,
        .blockquote-reverse small:after,
        blockquote.pull-right small:after,
        .blockquote-reverse .small:after,
        blockquote.pull-right .small:after {
            content: '\00A0 \2014';
        }
        address {
            margin-bottom: 20px;
            font-style: normal;
            line-height: 1.42857143;
        }
        code,
        kbd,
        pre,
        samp {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
        }
        code {
            padding: 2px 4px;
            font-size: 90%;
            color: #c7254e;
            background-color: #f9f2f4;
            border-radius: 4px;
        }
        kbd {
            padding: 2px 4px;
            font-size: 90%;
            color: #fff;
            background-color: #333;
            border-radius: 3px;
            -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .25);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .25);
        }
        kbd kbd {
            padding: 0;
            font-size: 100%;
            font-weight: bold;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        pre {
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-all;
            word-wrap: break-word;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        pre code {
            padding: 0;
            font-size: inherit;
            color: inherit;
            white-space: pre-wrap;
            background-color: transparent;
            border-radius: 0;
        }
        .pre-scrollable {
            max-height: 340px;
            overflow-y: scroll;
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        @media (min-width: 768px) {
            .container {
                width: 750px;
            }
        }
        @media (min-width: 992px) {
            .container {
                width: 970px;
            }
        }
        @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
        }
        .container-fluid {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
            float: right;
        }
        .col-xs-12 {
            width: 100%;
        }
        .col-xs-11 {
            width: 91.66666667%;
        }
        .col-xs-10 {
            width: 83.33333333%;
        }
        .col-xs-9 {
            width: 75%;
        }
        .col-xs-8 {
            width: 66.66666667%;
        }
        .col-xs-7 {
            width: 58.33333333%;
        }
        .col-xs-6 {
            width: 50%;
        }
        .col-xs-5 {
            width: 41.66666667%;
        }
        .col-xs-4 {
            width: 33.33333333%;
        }
        .col-xs-3 {
            width: 25%;
        }
        .col-xs-2 {
            width: 16.66666667%;
        }
        .col-xs-1 {
            width: 8.33333333%;
        }
        .col-xs-pull-12 {
            right: 100%;
        }
        .col-xs-pull-11 {
            right: 91.66666667%;
        }
        .col-xs-pull-10 {
            right: 83.33333333%;
        }
        .col-xs-pull-9 {
            right: 75%;
        }
        .col-xs-pull-8 {
            right: 66.66666667%;
        }
        .col-xs-pull-7 {
            right: 58.33333333%;
        }
        .col-xs-pull-6 {
            right: 50%;
        }
        .col-xs-pull-5 {
            right: 41.66666667%;
        }
        .col-xs-pull-4 {
            right: 33.33333333%;
        }
        .col-xs-pull-3 {
            right: 25%;
        }
        .col-xs-pull-2 {
            right: 16.66666667%;
        }
        .col-xs-pull-1 {
            right: 8.33333333%;
        }
        .col-xs-pull-0 {
            right: auto;
        }
        .col-xs-push-12 {
            left: 100%;
        }
        .col-xs-push-11 {
            left: 91.66666667%;
        }
        .col-xs-push-10 {
            left: 83.33333333%;
        }
        .col-xs-push-9 {
            left: 75%;
        }
        .col-xs-push-8 {
            left: 66.66666667%;
        }
        .col-xs-push-7 {
            left: 58.33333333%;
        }
        .col-xs-push-6 {
            left: 50%;
        }
        .col-xs-push-5 {
            left: 41.66666667%;
        }
        .col-xs-push-4 {
            left: 33.33333333%;
        }
        .col-xs-push-3 {
            left: 25%;
        }
        .col-xs-push-2 {
            left: 16.66666667%;
        }
        .col-xs-push-1 {
            left: 8.33333333%;
        }
        .col-xs-push-0 {
            left: auto;
        }
        .col-xs-offset-12 {
            margin-left: 100%;
        }
        .col-xs-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-xs-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-xs-offset-9 {
            margin-left: 75%;
        }
        .col-xs-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-xs-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-xs-offset-6 {
            margin-left: 50%;
        }
        .col-xs-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-xs-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-xs-offset-3 {
            margin-left: 25%;
        }
        .col-xs-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-xs-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-xs-offset-0 {
            margin-left: 0;
        }
        @media (min-width: 768px) {
            .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
                float: right;
            }
            .col-sm-12 {
                width: 100%;
            }
            .col-sm-11 {
                width: 91.66666667%;
            }
            .col-sm-10 {
                width: 83.33333333%;
            }
            .col-sm-9 {
                width: 75%;
            }
            .col-sm-8 {
                width: 66.66666667%;
            }
            .col-sm-7 {
                width: 58.33333333%;
            }
            .col-sm-6 {
                width: 50%;
            }
            .col-sm-5 {
                width: 41.66666667%;
            }
            .col-sm-4 {
                width: 33.33333333%;
            }
            .col-sm-3 {
                width: 25%;
            }
            .col-sm-2 {
                width: 16.66666667%;
            }
            .col-sm-1 {
                width: 8.33333333%;
            }
            .col-sm-pull-12 {
                right: 100%;
            }
            .col-sm-pull-11 {
                right: 91.66666667%;
            }
            .col-sm-pull-10 {
                right: 83.33333333%;
            }
            .col-sm-pull-9 {
                right: 75%;
            }
            .col-sm-pull-8 {
                right: 66.66666667%;
            }
            .col-sm-pull-7 {
                right: 58.33333333%;
            }
            .col-sm-pull-6 {
                right: 50%;
            }
            .col-sm-pull-5 {
                right: 41.66666667%;
            }
            .col-sm-pull-4 {
                right: 33.33333333%;
            }
            .col-sm-pull-3 {
                right: 25%;
            }
            .col-sm-pull-2 {
                right: 16.66666667%;
            }
            .col-sm-pull-1 {
                right: 8.33333333%;
            }
            .col-sm-pull-0 {
                right: auto;
            }
            .col-sm-push-12 {
                left: 100%;
            }
            .col-sm-push-11 {
                left: 91.66666667%;
            }
            .col-sm-push-10 {
                left: 83.33333333%;
            }
            .col-sm-push-9 {
                left: 75%;
            }
            .col-sm-push-8 {
                left: 66.66666667%;
            }
            .col-sm-push-7 {
                left: 58.33333333%;
            }
            .col-sm-push-6 {
                left: 50%;
            }
            .col-sm-push-5 {
                left: 41.66666667%;
            }
            .col-sm-push-4 {
                left: 33.33333333%;
            }
            .col-sm-push-3 {
                left: 25%;
            }
            .col-sm-push-2 {
                left: 16.66666667%;
            }
            .col-sm-push-1 {
                left: 8.33333333%;
            }
            .col-sm-push-0 {
                left: auto;
            }
            .col-sm-offset-12 {
                margin-left: 100%;
            }
            .col-sm-offset-11 {
                margin-left: 91.66666667%;
            }
            .col-sm-offset-10 {
                margin-left: 83.33333333%;
            }
            .col-sm-offset-9 {
                margin-left: 75%;
            }
            .col-sm-offset-8 {
                margin-left: 66.66666667%;
            }
            .col-sm-offset-7 {
                margin-left: 58.33333333%;
            }
            .col-sm-offset-6 {
                margin-left: 50%;
            }
            .col-sm-offset-5 {
                margin-left: 41.66666667%;
            }
            .col-sm-offset-4 {
                margin-left: 33.33333333%;
            }
            .col-sm-offset-3 {
                margin-left: 25%;
            }
            .col-sm-offset-2 {
                margin-left: 16.66666667%;
            }
            .col-sm-offset-1 {
                margin-left: 8.33333333%;
            }
            .col-sm-offset-0 {
                margin-left: 0;
            }
        }
        @media (min-width: 992px) {
            .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
                float: right;
            }
            .col-md-12 {
                width: 100%;
            }
            .col-md-11 {
                width: 91.66666667%;
            }
            .col-md-10 {
                width: 83.33333333%;
            }
            .col-md-9 {
                width: 75%;
            }
            .col-md-8 {
                width: 66.66666667%;
            }
            .col-md-7 {
                width: 58.33333333%;
            }
            .col-md-6 {
                width: 50%;
            }
            .col-md-5 {
                width: 41.66666667%;
            }
            .col-md-4 {
                width: 33.33333333%;
            }
            .col-md-3 {
                width: 25%;
            }
            .col-md-2 {
                width: 16.66666667%;
            }
            .col-md-1 {
                width: 8.33333333%;
            }
            .col-md-pull-12 {
                right: 100%;
            }
            .col-md-pull-11 {
                right: 91.66666667%;
            }
            .col-md-pull-10 {
                right: 83.33333333%;
            }
            .col-md-pull-9 {
                right: 75%;
            }
            .col-md-pull-8 {
                right: 66.66666667%;
            }
            .col-md-pull-7 {
                right: 58.33333333%;
            }
            .col-md-pull-6 {
                right: 50%;
            }
            .col-md-pull-5 {
                right: 41.66666667%;
            }
            .col-md-pull-4 {
                right: 33.33333333%;
            }
            .col-md-pull-3 {
                right: 25%;
            }
            .col-md-pull-2 {
                right: 16.66666667%;
            }
            .col-md-pull-1 {
                right: 8.33333333%;
            }
            .col-md-pull-0 {
                right: auto;
            }
            .col-md-push-12 {
                left: 100%;
            }
            .col-md-push-11 {
                left: 91.66666667%;
            }
            .col-md-push-10 {
                left: 83.33333333%;
            }
            .col-md-push-9 {
                left: 75%;
            }
            .col-md-push-8 {
                left: 66.66666667%;
            }
            .col-md-push-7 {
                left: 58.33333333%;
            }
            .col-md-push-6 {
                left: 50%;
            }
            .col-md-push-5 {
                left: 41.66666667%;
            }
            .col-md-push-4 {
                left: 33.33333333%;
            }
            .col-md-push-3 {
                left: 25%;
            }
            .col-md-push-2 {
                left: 16.66666667%;
            }
            .col-md-push-1 {
                left: 8.33333333%;
            }
            .col-md-push-0 {
                left: auto;
            }
            .col-md-offset-12 {
                margin-left: 100%;
            }
            .col-md-offset-11 {
                margin-left: 91.66666667%;
            }
            .col-md-offset-10 {
                margin-left: 83.33333333%;
            }
            .col-md-offset-9 {
                margin-left: 75%;
            }
            .col-md-offset-8 {
                margin-left: 66.66666667%;
            }
            .col-md-offset-7 {
                margin-left: 58.33333333%;
            }
            .col-md-offset-6 {
                margin-left: 50%;
            }
            .col-md-offset-5 {
                margin-left: 41.66666667%;
            }
            .col-md-offset-4 {
                margin-left: 33.33333333%;
            }
            .col-md-offset-3 {
                margin-left: 25%;
            }
            .col-md-offset-2 {
                margin-left: 16.66666667%;
            }
            .col-md-offset-1 {
                margin-left: 8.33333333%;
            }
            .col-md-offset-0 {
                margin-left: 0;
            }
        }
        @media (min-width: 1200px) {
            .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
                float: right;
            }
            .col-lg-12 {
                width: 100%;
            }
            .col-lg-11 {
                width: 91.66666667%;
            }
            .col-lg-10 {
                width: 83.33333333%;
            }
            .col-lg-9 {
                width: 75%;
            }
            .col-lg-8 {
                width: 66.66666667%;
            }
            .col-lg-7 {
                width: 58.33333333%;
            }
            .col-lg-6 {
                width: 50%;
            }
            .col-lg-5 {
                width: 41.66666667%;
            }
            .col-lg-4 {
                width: 33.33333333%;
            }
            .col-lg-3 {
                width: 25%;
            }
            .col-lg-2 {
                width: 16.66666667%;
            }
            .col-lg-1 {
                width: 8.33333333%;
            }
            .col-lg-pull-12 {
                right: 100%;
            }
            .col-lg-pull-11 {
                right: 91.66666667%;
            }
            .col-lg-pull-10 {
                right: 83.33333333%;
            }
            .col-lg-pull-9 {
                right: 75%;
            }
            .col-lg-pull-8 {
                right: 66.66666667%;
            }
            .col-lg-pull-7 {
                right: 58.33333333%;
            }
            .col-lg-pull-6 {
                right: 50%;
            }
            .col-lg-pull-5 {
                right: 41.66666667%;
            }
            .col-lg-pull-4 {
                right: 33.33333333%;
            }
            .col-lg-pull-3 {
                right: 25%;
            }
            .col-lg-pull-2 {
                right: 16.66666667%;
            }
            .col-lg-pull-1 {
                right: 8.33333333%;
            }
            .col-lg-pull-0 {
                right: auto;
            }
            .col-lg-push-12 {
                left: 100%;
            }
            .col-lg-push-11 {
                left: 91.66666667%;
            }
            .col-lg-push-10 {
                left: 83.33333333%;
            }
            .col-lg-push-9 {
                left: 75%;
            }
            .col-lg-push-8 {
                left: 66.66666667%;
            }
            .col-lg-push-7 {
                left: 58.33333333%;
            }
            .col-lg-push-6 {
                left: 50%;
            }
            .col-lg-push-5 {
                left: 41.66666667%;
            }
            .col-lg-push-4 {
                left: 33.33333333%;
            }
            .col-lg-push-3 {
                left: 25%;
            }
            .col-lg-push-2 {
                left: 16.66666667%;
            }
            .col-lg-push-1 {
                left: 8.33333333%;
            }
            .col-lg-push-0 {
                left: auto;
            }
            .col-lg-offset-12 {
                margin-left: 100%;
            }
            .col-lg-offset-11 {
                margin-left: 91.66666667%;
            }
            .col-lg-offset-10 {
                margin-left: 83.33333333%;
            }
            .col-lg-offset-9 {
                margin-left: 75%;
            }
            .col-lg-offset-8 {
                margin-left: 66.66666667%;
            }
            .col-lg-offset-7 {
                margin-left: 58.33333333%;
            }
            .col-lg-offset-6 {
                margin-left: 50%;
            }
            .col-lg-offset-5 {
                margin-left: 41.66666667%;
            }
            .col-lg-offset-4 {
                margin-left: 33.33333333%;
            }
            .col-lg-offset-3 {
                margin-left: 25%;
            }
            .col-lg-offset-2 {
                margin-left: 16.66666667%;
            }
            .col-lg-offset-1 {
                margin-left: 8.33333333%;
            }
            .col-lg-offset-0 {
                margin-left: 0;
            }
        }
        table {
            background-color: transparent;
        }
        caption {
            padding-top: 8px;
            padding-bottom: 8px;
            color: #777;
            text-align: right;
        }
        th {
            text-align: right;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            direction: rtl;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: middle;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }
        .table > tbody + tbody {
            border-top: 2px solid #ddd;
        }
        .table .table {
            background-color: #fff;
        }
        .table-condensed > thead > tr > th,
        .table-condensed > tbody > tr > th,
        .table-condensed > tfoot > tr > th,
        .table-condensed > thead > tr > td,
        .table-condensed > tbody > tr > td,
        .table-condensed > tfoot > tr > td {
            padding: 5px;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #ddd;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-hover > tbody > tr:hover {
            background-color: #f5f5f5;
        }
        table col[class*="col-"] {
            position: static;
            display: table-column;
            float: none;
        }
        table td[class*="col-"],
        table th[class*="col-"] {
            position: static;
            display: table-cell;
            float: none;
        }
        .table > thead > tr > td.active,
        .table > tbody > tr > td.active,
        .table > tfoot > tr > td.active,
        .table > thead > tr > th.active,
        .table > tbody > tr > th.active,
        .table > tfoot > tr > th.active,
        .table > thead > tr.active > td,
        .table > tbody > tr.active > td,
        .table > tfoot > tr.active > td,
        .table > thead > tr.active > th,
        .table > tbody > tr.active > th,
        .table > tfoot > tr.active > th {
            background-color: #f5f5f5;
        }
        .table-hover > tbody > tr > td.active:hover,
        .table-hover > tbody > tr > th.active:hover,
        .table-hover > tbody > tr.active:hover > td,
        .table-hover > tbody > tr:hover > .active,
        .table-hover > tbody > tr.active:hover > th {
            background-color: #e8e8e8;
        }
        .table > thead > tr > td.success,
        .table > tbody > tr > td.success,
        .table > tfoot > tr > td.success,
        .table > thead > tr > th.success,
        .table > tbody > tr > th.success,
        .table > tfoot > tr > th.success,
        .table > thead > tr.success > td,
        .table > tbody > tr.success > td,
        .table > tfoot > tr.success > td,
        .table > thead > tr.success > th,
        .table > tbody > tr.success > th,
        .table > tfoot > tr.success > th {
            background-color: #dff0d8;
        }
        .table-hover > tbody > tr > td.success:hover,
        .table-hover > tbody > tr > th.success:hover,
        .table-hover > tbody > tr.success:hover > td,
        .table-hover > tbody > tr:hover > .success,
        .table-hover > tbody > tr.success:hover > th {
            background-color: #d0e9c6;
        }
        .table > thead > tr > td.info,
        .table > tbody > tr > td.info,
        .table > tfoot > tr > td.info,
        .table > thead > tr > th.info,
        .table > tbody > tr > th.info,
        .table > tfoot > tr > th.info,
        .table > thead > tr.info > td,
        .table > tbody > tr.info > td,
        .table > tfoot > tr.info > td,
        .table > thead > tr.info > th,
        .table > tbody > tr.info > th,
        .table > tfoot > tr.info > th {
            background-color: #d9edf7;
        }
        .table-hover > tbody > tr > td.info:hover,
        .table-hover > tbody > tr > th.info:hover,
        .table-hover > tbody > tr.info:hover > td,
        .table-hover > tbody > tr:hover > .info,
        .table-hover > tbody > tr.info:hover > th {
            background-color: #c4e3f3;
        }
        .table > thead > tr > td.warning,
        .table > tbody > tr > td.warning,
        .table > tfoot > tr > td.warning,
        .table > thead > tr > th.warning,
        .table > tbody > tr > th.warning,
        .table > tfoot > tr > th.warning,
        .table > thead > tr.warning > td,
        .table > tbody > tr.warning > td,
        .table > tfoot > tr.warning > td,
        .table > thead > tr.warning > th,
        .table > tbody > tr.warning > th,
        .table > tfoot > tr.warning > th {
            background-color: #fcf8e3;
        }
        .table-hover > tbody > tr > td.warning:hover,
        .table-hover > tbody > tr > th.warning:hover,
        .table-hover > tbody > tr.warning:hover > td,
        .table-hover > tbody > tr:hover > .warning,
        .table-hover > tbody > tr.warning:hover > th {
            background-color: #faf2cc;
        }
        .table > thead > tr > td.danger,
        .table > tbody > tr > td.danger,
        .table > tfoot > tr > td.danger,
        .table > thead > tr > th.danger,
        .table > tbody > tr > th.danger,
        .table > tfoot > tr > th.danger,
        .table > thead > tr.danger > td,
        .table > tbody > tr.danger > td,
        .table > tfoot > tr.danger > td,
        .table > thead > tr.danger > th,
        .table > tbody > tr.danger > th,
        .table > tfoot > tr.danger > th {
            background-color: #f2dede;
        }
        .table-hover > tbody > tr > td.danger:hover,
        .table-hover > tbody > tr > th.danger:hover,
        .table-hover > tbody > tr.danger:hover > td,
        .table-hover > tbody > tr:hover > .danger,
        .table-hover > tbody > tr.danger:hover > th {
            background-color: #ebcccc;
        }
        .table-responsive {
            min-height: .01%;
            overflow-x: auto;
        }
        @media screen and (max-width: 767px) {
            .table-responsive {
                width: 100%;
                margin-bottom: 15px;
                overflow-y: hidden;
                -ms-overflow-style: -ms-autohiding-scrollbar;
                border: 1px solid #ddd;
            }
            .table-responsive > .table {
                margin-bottom: 0;
            }
            .table-responsive > .table > thead > tr > th,
            .table-responsive > .table > tbody > tr > th,
            .table-responsive > .table > tfoot > tr > th,
            .table-responsive > .table > thead > tr > td,
            .table-responsive > .table > tbody > tr > td,
            .table-responsive > .table > tfoot > tr > td {
                white-space: nowrap;
            }
            .table-responsive > .table-bordered {
                border: 0;
            }
            .table-responsive > .table-bordered > thead > tr > th:first-child,
            .table-responsive > .table-bordered > tbody > tr > th:first-child,
            .table-responsive > .table-bordered > tfoot > tr > th:first-child,
            .table-responsive > .table-bordered > thead > tr > td:first-child,
            .table-responsive > .table-bordered > tbody > tr > td:first-child,
            .table-responsive > .table-bordered > tfoot > tr > td:first-child {
                border-left: 0;
            }
            .table-responsive > .table-bordered > thead > tr > th:last-child,
            .table-responsive > .table-bordered > tbody > tr > th:last-child,
            .table-responsive > .table-bordered > tfoot > tr > th:last-child,
            .table-responsive > .table-bordered > thead > tr > td:last-child,
            .table-responsive > .table-bordered > tbody > tr > td:last-child,
            .table-responsive > .table-bordered > tfoot > tr > td:last-child {
                border-right: 0;
            }
            .table-responsive > .table-bordered > tbody > tr:last-child > th,
            .table-responsive > .table-bordered > tfoot > tr:last-child > th,
            .table-responsive > .table-bordered > tbody > tr:last-child > td,
            .table-responsive > .table-bordered > tfoot > tr:last-child > td {
                border-bottom: 0;
            }
        }
        fieldset {
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0;
        }
        legend {
            display: block;
            width: 100%;
            padding: 0;
            margin-bottom: 20px;
            font-size: 21px;
            line-height: inherit;
            color: #333;
            border: 0;
            border-bottom: 1px solid #e5e5e5;
        }
        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="search"] {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        input[type="radio"],
        input[type="checkbox"] {
            margin: 4px 0 0;
            margin-top: 1px \9;
            line-height: normal;
        }
        input[type="file"] {
            display: block;
        }
        input[type="range"] {
            display: block;
            width: 100%;
        }
        select[multiple],
        select[size] {
            height: auto;
        }
        input[type="file"]:focus,
        input[type="radio"]:focus,
        input[type="checkbox"]:focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }
        output {
            display: block;
            padding-top: 7px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
        }
        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            line-height: 34px;
            padding: 6px 12px;
            font-size: 12px;
            line-height: 1.42857143;
            color: #777;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc !important;
            direction: rtl;
            border-radius: 4px;
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .form-control:focus {
            border:1px solid #ff8c3f;
            outline: 0;
        }
        .form-control::-moz-placeholder {
            color: #999;
        }
        .form-control:-ms-input-placeholder {
            color: #999;
        }
        .form-control::-webkit-input-placeholder {
            color: #999;
        }
        .form-control::-ms-expand {
            background-color: transparent;
            border: 0;
        }
        .form-control[disabled],
        .form-control[readonly],
        fieldset[disabled] .form-control {
            background-color: #eee;
            opacity: 1;
        }
        .form-control[disabled],
        fieldset[disabled] .form-control {
            cursor: not-allowed;
        }
        textarea.form-control {
            height: auto;
        }
        input[type="search"] {
            -webkit-appearance: none;
        }
        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            input[type="date"].form-control,
            input[type="time"].form-control,
            input[type="datetime-local"].form-control,
            input[type="month"].form-control {
                line-height: 34px;
            }
            input[type="date"].input-sm,
            input[type="time"].input-sm,
            input[type="datetime-local"].input-sm,
            input[type="month"].input-sm,
            .input-group-sm input[type="date"],
            .input-group-sm input[type="time"],
            .input-group-sm input[type="datetime-local"],
            .input-group-sm input[type="month"] {
                line-height: 30px;
            }
            input[type="date"].input-lg,
            input[type="time"].input-lg,
            input[type="datetime-local"].input-lg,
            input[type="month"].input-lg,
            .input-group-lg input[type="date"],
            .input-group-lg input[type="time"],
            .input-group-lg input[type="datetime-local"],
            .input-group-lg input[type="month"] {
                line-height: 46px;
            }
        }
        .form-group {
            margin-bottom: 15px;
        }
        .radio,
        .checkbox {
            position: relative;
            display: block;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .radio label,
        .checkbox label {
            min-height: 20px;
            padding-left: 20px;
            margin-bottom: 0;
            font-weight: normal;
            cursor: pointer;
        }
        .radio input[type="radio"],
        .radio-inline input[type="radio"],
        .checkbox input[type="checkbox"],
        .checkbox-inline input[type="checkbox"] {
            position: absolute;
            margin-top: 4px \9;
            margin-right: -20px;
        }
        .radio + .radio,
        .checkbox + .checkbox {
            margin-top: -5px;
        }
        .radio-inline,
        .checkbox-inline {
            cursor: pointer;
            display: inline-block;
            font-weight: normal;
            margin-bottom: 0;
            padding:0 20px 0px 0px;
            position: relative;
            vertical-align: middle;
            width: 100%;
            text-align: right
        }
        .radio-inline + .radio-inline,
        .checkbox-inline + .checkbox-inline {
            margin-top: 0;
            margin-left: 10px;
        }
        input[type="radio"][disabled],
        input[type="checkbox"][disabled],
        input[type="radio"].disabled,
        input[type="checkbox"].disabled,
        fieldset[disabled] input[type="radio"],
        fieldset[disabled] input[type="checkbox"] {
            cursor: not-allowed;
        }
        .radio-inline.disabled,
        .checkbox-inline.disabled,
        fieldset[disabled] .radio-inline,
        fieldset[disabled] .checkbox-inline {
            cursor: not-allowed;
        }
        .radio.disabled label,
        .checkbox.disabled label,
        fieldset[disabled] .radio label,
        fieldset[disabled] .checkbox label {
            cursor: not-allowed;
        }
        .form-control-static {
            min-height: 34px;
            padding-top: 7px;
            padding-bottom: 7px;
            margin-bottom: 0;
        }
        .form-control-static.input-lg,
        .form-control-static.input-sm {
            padding-right: 0;
            padding-left: 0;
        }
        .input-sm {
            height: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        select.input-sm {
            height: 30px;
            line-height: 30px;
        }
        textarea.input-sm,
        select[multiple].input-sm {
            height: auto;
        }
        .form-group-sm .form-control {
            height: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        .form-group-sm select.form-control {
            height: 30px;
            line-height: 30px;
        }
        .form-group-sm textarea.form-control,
        .form-group-sm select[multiple].form-control {
            height: auto;
        }
        .form-group-sm .form-control-static {
            height: 30px;
            min-height: 32px;
            padding: 6px 10px;
            font-size: 12px;
            line-height: 1.5;
        }
        .input-lg {
            height: 46px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
            border-radius: 6px;
        }
        select.input-lg {
            height: 46px;
            line-height: 46px;
        }
        textarea.input-lg,
        select[multiple].input-lg {
            height: auto;
        }
        .form-group-lg .form-control {
            height: 46px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
            border-radius: 6px;
        }
        .form-group-lg select.form-control {
            height: 46px;
            line-height: 46px;
        }
        .form-group-lg textarea.form-control,
        .form-group-lg select[multiple].form-control {
            height: auto;
        }
        .form-group-lg .form-control-static {
            height: 46px;
            min-height: 38px;
            padding: 11px 16px;
            font-size: 18px;
            line-height: 1.3333333;
        }
        .has-feedback {
            position: relative;
        }
        .has-feedback .form-control {
            padding-right: 42.5px;
        }
        .form-control-feedback {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            pointer-events: none;
        }
        .input-lg + .form-control-feedback,
        .input-group-lg + .form-control-feedback,
        .form-group-lg .form-control + .form-control-feedback {
            width: 46px;
            height: 46px;
            line-height: 46px;
        }
        .input-sm + .form-control-feedback,
        .input-group-sm + .form-control-feedback,
        .form-group-sm .form-control + .form-control-feedback {
            width: 30px;
            height: 30px;
            line-height: 30px;
        }
        .has-success .help-block,
        .has-success .control-label,
        .has-success .radio,
        .has-success .checkbox,
        .has-success .radio-inline,
        .has-success .checkbox-inline,
        .has-success.radio label,
        .has-success.checkbox label,
        .has-success.radio-inline label,
        .has-success.checkbox-inline label {
            color: #3c763d;
        }
        .has-success .form-control {
            border-color: #3c763d;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }
        .has-success .form-control:focus {
            border-color: #2b542c;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168;
        }
        .has-success .input-group-addon {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #3c763d;
        }
        .has-success .form-control-feedback {
            color: #3c763d;
        }
        .has-warning .help-block,
        .has-warning .control-label,
        .has-warning .radio,
        .has-warning .checkbox,
        .has-warning .radio-inline,
        .has-warning .checkbox-inline,
        .has-warning.radio label,
        .has-warning.checkbox label,
        .has-warning.radio-inline label,
        .has-warning.checkbox-inline label {
            color: #8a6d3b;
        }
        .has-warning .form-control {
            border-color: #8a6d3b;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }
        .has-warning .form-control:focus {
            border-color: #66512c;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #c0a16b;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #c0a16b;
        }
        .has-warning .input-group-addon {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #8a6d3b;
        }
        .has-warning .form-control-feedback {
            color: #8a6d3b;
        }
        .has-error .help-block,
        .has-error .control-label,
        .has-error .radio,
        .has-error .checkbox,
        .has-error .radio-inline,
        .has-error .checkbox-inline,
        .has-error.radio label,
        .has-error.checkbox label,
        .has-error.radio-inline label,
        .has-error.checkbox-inline label {
            color: #a94442;
        }
        .has-error .form-control {
            border-color: #a94442;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }
        .has-error .form-control:focus {
            border-color: #843534;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
        }
        .has-error .input-group-addon {
            color: #a94442;
            background-color: #f2dede;
            border-color: #a94442;
        }
        .has-error .form-control-feedback {
            color: #a94442;
        }
        .has-feedback label ~ .form-control-feedback {
            top: 25px;
        }
        .has-feedback label.sr-only ~ .form-control-feedback {
            top: 0;
        }
        .help-block {
            color: #da4348;
            display: block;
            font-size: 11px;
            margin-bottom: 10px;

        }
        @media (min-width: 768px) {
            .form-inline .form-group {
                display: inline-block;
                margin-bottom: 0;
                vertical-align: middle;
            }
            .form-inline .form-control {
                display: inline-block;
                width: auto;
                vertical-align: middle;
            }
            .form-inline .form-control-static {
                display: inline-block;
            }
            .form-inline .input-group {
                display: inline-table;
                vertical-align: middle;
            }
            .form-inline .input-group .input-group-addon,
            .form-inline .input-group .input-group-btn,
            .form-inline .input-group .form-control {
                width: auto;
            }
            .form-inline .input-group > .form-control {
                width: 100%;
            }
            .form-inline .control-label {
                margin-bottom: 0;
                vertical-align: middle;
            }
            .form-inline .radio,
            .form-inline .checkbox {
                display: inline-block;
                margin-top: 0;
                margin-bottom: 0;
                vertical-align: middle;
            }
            .form-inline .radio label,
            .form-inline .checkbox label {
                padding-left: 0;
            }
            .form-inline .radio input[type="radio"],
            .form-inline .checkbox input[type="checkbox"] {
                position: relative;
                margin-left: 0;
            }
            .form-inline .has-feedback .form-control-feedback {
                top: 0;
            }
        }
        .form-horizontal .radio,
        .form-horizontal .checkbox,
        .form-horizontal .radio-inline,
        .form-horizontal .checkbox-inline {
            margin-top: 0;
            margin-bottom: 0;
        }
        .form-horizontal .radio,
        .form-horizontal .checkbox {
            min-height: 27px;
        }
        .form-horizontal .form-group {
            margin-right: -15px;
            margin-left: -15px;
        }
        @media (min-width: 768px) {
            .form-horizontal .control-label {
                padding-top: 7px;
                margin-bottom: 0;
                text-align: right;
                font-weight: 500;
            }
        }
        .form-horizontal .has-feedback .form-control-feedback {
            right: 15px;
        }
        @media (min-width: 768px) {
            .form-horizontal .form-group-lg .control-label {
                padding-top: 11px;
                font-size: 18px;
            }
        }
        @media (min-width: 768px) {
            .form-horizontal .form-group-sm .control-label {
                padding-top: 6px;
                font-size: 12px;
            }
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn:focus,
        .btn:active:focus,
        .btn.active:focus,
        .btn.focus,
        .btn:active.focus,
        .btn.active.focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }
        .btn:hover,
        .btn:focus,
        .btn.focus {
            color: #333;
            text-decoration: none;
        }
        .btn:active,
        .btn.active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
        }
        .btn.disabled,
        .btn[disabled],
        fieldset[disabled] .btn {
            cursor: not-allowed;
            filter: alpha(opacity=65);
            -webkit-box-shadow: none;
            box-shadow: none;
            opacity: .65;
        }
        a.btn.disabled,
        fieldset[disabled] a.btn {
            pointer-events: none;
        }
        .btn-default {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        .btn-default:focus,
        .btn-default.focus {
            color: #333;
            background-color: #e6e6e6;
            border-color: #8c8c8c;
        }
        .btn-default:hover {
            color: #333;
            background-color: #e6e6e6;
            border-color: #adadad;
        }
        .btn-default:active,
        .btn-default.active,
        .open > .dropdown-toggle.btn-default {
            color: #333;
            background-color: #e6e6e6;
            border-color: #adadad;
        }
        .btn-default:active:hover,
        .btn-default.active:hover,
        .open > .dropdown-toggle.btn-default:hover,
        .btn-default:active:focus,
        .btn-default.active:focus,
        .open > .dropdown-toggle.btn-default:focus,
        .btn-default:active.focus,
        .btn-default.active.focus,
        .open > .dropdown-toggle.btn-default.focus {
            color: #333;
            background-color: #d4d4d4;
            border-color: #8c8c8c;
        }
        .btn-default:active,
        .btn-default.active,
        .open > .dropdown-toggle.btn-default {
            background-image: none;
        }
        .btn-default.disabled:hover,
        .btn-default[disabled]:hover,
        fieldset[disabled] .btn-default:hover,
        .btn-default.disabled:focus,
        .btn-default[disabled]:focus,
        fieldset[disabled] .btn-default:focus,
        .btn-default.disabled.focus,
        .btn-default[disabled].focus,
        fieldset[disabled] .btn-default.focus {
            background-color: #fff;
            border-color: #ccc;
        }
        .btn-default .badge {
            color: #fff;
            background-color: #333;
        }
        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }
        .btn-primary:focus,
        .btn-primary.focus {
            color: #fff;
            background-color: #286090;
            border-color: #122b40;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #286090;
            border-color: #204d74;
        }
        .btn-primary:active,
        .btn-primary.active,
        .open > .dropdown-toggle.btn-primary {
            color: #fff;
            background-color: #286090;
            border-color: #204d74;
        }
        .btn-primary:active:hover,
        .btn-primary.active:hover,
        .open > .dropdown-toggle.btn-primary:hover,
        .btn-primary:active:focus,
        .btn-primary.active:focus,
        .open > .dropdown-toggle.btn-primary:focus,
        .btn-primary:active.focus,
        .btn-primary.active.focus,
        .open > .dropdown-toggle.btn-primary.focus {
            color: #fff;
            background-color: #204d74;
            border-color: #122b40;
        }
        .btn-primary:active,
        .btn-primary.active,
        .open > .dropdown-toggle.btn-primary {
            background-image: none;
        }
        .btn-primary.disabled:hover,
        .btn-primary[disabled]:hover,
        fieldset[disabled] .btn-primary:hover,
        .btn-primary.disabled:focus,
        .btn-primary[disabled]:focus,
        fieldset[disabled] .btn-primary:focus,
        .btn-primary.disabled.focus,
        .btn-primary[disabled].focus,
        fieldset[disabled] .btn-primary.focus {
            background-color: #337ab7;
            border-color: #2e6da4;
        }
        .btn-primary .badge {
            color: #337ab7;
            background-color: #fff;
        }
        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        .btn-success:focus,
        .btn-success.focus {
            color: #fff;
            background-color: #449d44;
            border-color: #255625;
        }
        .btn-success:hover {
            color: #fff;
            background-color: #449d44;
            border-color: #398439;
        }
        .btn-success:active,
        .btn-success.active,
        .open > .dropdown-toggle.btn-success {
            color: #fff;
            background-color: #449d44;
            border-color: #398439;
        }
        .btn-success:active:hover,
        .btn-success.active:hover,
        .open > .dropdown-toggle.btn-success:hover,
        .btn-success:active:focus,
        .btn-success.active:focus,
        .open > .dropdown-toggle.btn-success:focus,
        .btn-success:active.focus,
        .btn-success.active.focus,
        .open > .dropdown-toggle.btn-success.focus {
            color: #fff;
            background-color: #398439;
            border-color: #255625;
        }
        .btn-success:active,
        .btn-success.active,
        .open > .dropdown-toggle.btn-success {
            background-image: none;
        }
        .btn-success.disabled:hover,
        .btn-success[disabled]:hover,
        fieldset[disabled] .btn-success:hover,
        .btn-success.disabled:focus,
        .btn-success[disabled]:focus,
        fieldset[disabled] .btn-success:focus,
        .btn-success.disabled.focus,
        .btn-success[disabled].focus,
        fieldset[disabled] .btn-success.focus {
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        .btn-success .badge {
            color: #5cb85c;
            background-color: #fff;
        }
        .btn-info {
            color: #fff;
            background-color: #5bc0de;
            border-color: #46b8da;
        }
        .btn-info:focus,
        .btn-info.focus {
            color: #fff;
            background-color: #31b0d5;
            border-color: #1b6d85;
        }
        .btn-info:hover {
            color: #fff;
            background-color: #31b0d5;
            border-color: #269abc;
        }
        .btn-info:active,
        .btn-info.active,
        .open > .dropdown-toggle.btn-info {
            color: #fff;
            background-color: #31b0d5;
            border-color: #269abc;
        }
        .btn-info:active:hover,
        .btn-info.active:hover,
        .open > .dropdown-toggle.btn-info:hover,
        .btn-info:active:focus,
        .btn-info.active:focus,
        .open > .dropdown-toggle.btn-info:focus,
        .btn-info:active.focus,
        .btn-info.active.focus,
        .open > .dropdown-toggle.btn-info.focus {
            color: #fff;
            background-color: #269abc;
            border-color: #1b6d85;
        }
        .btn-info:active,
        .btn-info.active,
        .open > .dropdown-toggle.btn-info {
            background-image: none;
        }
        .btn-info.disabled:hover,
        .btn-info[disabled]:hover,
        fieldset[disabled] .btn-info:hover,
        .btn-info.disabled:focus,
        .btn-info[disabled]:focus,
        fieldset[disabled] .btn-info:focus,
        .btn-info.disabled.focus,
        .btn-info[disabled].focus,
        fieldset[disabled] .btn-info.focus {
            background-color: #5bc0de;
            border-color: #46b8da;
        }
        .btn-info .badge {
            color: #5bc0de;
            background-color: #fff;
        }
        .btn-warning {
            color: #fff;
            background-color: #f0ad4e;
            border-color: #eea236;
        }
        .btn-warning:focus,
        .btn-warning.focus {
            color: #fff;
            background-color: #ec971f;
            border-color: #985f0d;
        }
        .btn-warning:hover {
            color: #fff;
            background-color: #ec971f;
            border-color: #d58512;
        }
        .btn-warning:active,
        .btn-warning.active,
        .open > .dropdown-toggle.btn-warning {
            color: #fff;
            background-color: #ec971f;
            border-color: #d58512;
        }
        .btn-warning:active:hover,
        .btn-warning.active:hover,
        .open > .dropdown-toggle.btn-warning:hover,
        .btn-warning:active:focus,
        .btn-warning.active:focus,
        .open > .dropdown-toggle.btn-warning:focus,
        .btn-warning:active.focus,
        .btn-warning.active.focus,
        .open > .dropdown-toggle.btn-warning.focus {
            color: #fff;
            background-color: #d58512;
            border-color: #985f0d;
        }
        .btn-warning:active,
        .btn-warning.active,
        .open > .dropdown-toggle.btn-warning {
            background-image: none;
        }
        .btn-warning.disabled:hover,
        .btn-warning[disabled]:hover,
        fieldset[disabled] .btn-warning:hover,
        .btn-warning.disabled:focus,
        .btn-warning[disabled]:focus,
        fieldset[disabled] .btn-warning:focus,
        .btn-warning.disabled.focus,
        .btn-warning[disabled].focus,
        fieldset[disabled] .btn-warning.focus {
            background-color: #f0ad4e;
            border-color: #eea236;
        }
        .btn-warning .badge {
            color: #f0ad4e;
            background-color: #fff;
        }
        .btn-danger {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .btn-danger:focus,
        .btn-danger.focus {
            color: #fff;
            background-color: #c9302c;
            border-color: #761c19;
        }
        .btn-danger:hover {
            color: #fff;
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .btn-danger:active,
        .btn-danger.active,
        .open > .dropdown-toggle.btn-danger {
            color: #fff;
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .btn-danger:active:hover,
        .btn-danger.active:hover,
        .open > .dropdown-toggle.btn-danger:hover,
        .btn-danger:active:focus,
        .btn-danger.active:focus,
        .open > .dropdown-toggle.btn-danger:focus,
        .btn-danger:active.focus,
        .btn-danger.active.focus,
        .open > .dropdown-toggle.btn-danger.focus {
            color: #fff;
            background-color: #ac2925;
            border-color: #761c19;
        }
        .btn-danger:active,
        .btn-danger.active,
        .open > .dropdown-toggle.btn-danger {
            background-image: none;
        }
        .btn-danger.disabled:hover,
        .btn-danger[disabled]:hover,
        fieldset[disabled] .btn-danger:hover,
        .btn-danger.disabled:focus,
        .btn-danger[disabled]:focus,
        fieldset[disabled] .btn-danger:focus,
        .btn-danger.disabled.focus,
        .btn-danger[disabled].focus,
        fieldset[disabled] .btn-danger.focus {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .btn-danger .badge {
            color: #d9534f;
            background-color: #fff;
        }
        .btn-link {
            font-weight: normal;
            color: #337ab7;
            border-radius: 0;
        }
        .btn-link,
        .btn-link:active,
        .btn-link.active,
        .btn-link[disabled],
        fieldset[disabled] .btn-link {
            background-color: transparent;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .btn-link,
        .btn-link:hover,
        .btn-link:focus,
        .btn-link:active {
            border-color: transparent;
        }
        .btn-link:hover,
        .btn-link:focus {
            color: #23527c;
            text-decoration: underline;
            background-color: transparent;
        }
        .btn-link[disabled]:hover,
        fieldset[disabled] .btn-link:hover,
        .btn-link[disabled]:focus,
        fieldset[disabled] .btn-link:focus {
            color: #777;
            text-decoration: none;
        }
        .btn-lg,
        .btn-group-lg > .btn {
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
            border-radius: 6px;
        }
        .btn-sm,
        .btn-group-sm > .btn {
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        .btn-xs,
        .btn-group-xs > .btn {
            padding: 1px 5px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .btn-block + .btn-block {
            margin-top: 5px;
        }
        input[type="submit"].btn-block,
        input[type="reset"].btn-block,
        input[type="button"].btn-block {
            width: 100%;
        }
        .fade {
            opacity: 0;
            -webkit-transition: opacity .15s linear;
            -o-transition: opacity .15s linear;
            transition: opacity .15s linear;
        }
        .fade.in {
            opacity: 1;
        }
        .collapse {
            display: none;
        }
        .collapse.in {
            display: block;
        }
        tr.collapse.in {
            display: table-row;
        }
        tbody.collapse.in {
            display: table-row-group;
        }
        .collapsing {
            position: relative;
            height: 0;
            overflow: hidden;
            -webkit-transition-timing-function: ease;
            -o-transition-timing-function: ease;
            transition-timing-function: ease;
            -webkit-transition-duration: .35s;
            -o-transition-duration: .35s;
            transition-duration: .35s;
            -webkit-transition-property: height, visibility;
            -o-transition-property: height, visibility;
            transition-property: height, visibility;
        }
        .caret {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 2px;
            vertical-align: middle;
            border-top: 4px dashed;
            border-top: 4px solid \9;
            border-right: 4px solid transparent;
            border-left: 4px solid transparent;
        }
        .dropup,
        .dropdown {
            position: relative;
        }
        .dropdown-toggle:focus {
            outline: 0;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            font-size: 14px;
            text-align: left;
            list-style: none;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        }
        .dropdown-menu.pull-right {
            right: 0;
            left: auto;
        }
        .dropdown-menu .divider {
            height: 1px;
            margin: 9px 0;
            overflow: hidden;
            background-color: #e5e5e5;
        }
        .dropdown-menu > li > a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }
        .dropdown-menu > li > a:hover,
        .dropdown-menu > li > a:focus {
            color: #262626;
            text-decoration: none;
            background-color: #f5f5f5;
        }
        .dropdown-menu > .active > a,
        .dropdown-menu > .active > a:hover,
        .dropdown-menu > .active > a:focus {
            color: #fff;
            text-decoration: none;
            background-color: #337ab7;
            outline: 0;
        }
        .dropdown-menu > .disabled > a,
        .dropdown-menu > .disabled > a:hover,
        .dropdown-menu > .disabled > a:focus {
            color: #777;
        }
        .dropdown-menu > .disabled > a:hover,
        .dropdown-menu > .disabled > a:focus {
            text-decoration: none;
            cursor: not-allowed;
            background-color: transparent;
            background-image: none;
            filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
        }
        .open > .dropdown-menu {
            display: block;
        }
        .open > a {
            outline: 0;
        }
        .dropdown-menu-right {
            right: 0;
            left: auto;
        }
        .dropdown-menu-left {
            right: auto;
            left: 0;
        }
        .dropdown-header {
            display: block;
            padding: 3px 20px;
            font-size: 12px;
            line-height: 1.42857143;
            color: #777;
            white-space: nowrap;
        }
        .dropdown-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 990;
        }
        .pull-right > .dropdown-menu {
            right: 0;
            left: auto;
        }
        .dropup .caret,
        .navbar-fixed-bottom .dropdown .caret {
            content: "";
            border-top: 0;
            border-bottom: 4px dashed;
            border-bottom: 4px solid \9;
        }
        .dropup .dropdown-menu,
        .navbar-fixed-bottom .dropdown .dropdown-menu {
            top: auto;
            bottom: 100%;
            margin-bottom: 2px;
        }
        @media (min-width: 768px) {
            .navbar-right .dropdown-menu {
                right: 0;
                left: auto;
            }
            .navbar-right .dropdown-menu-left {
                right: auto;
                left: 0;
            }
        }
        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
        }
        .btn-group > .btn,
        .btn-group-vertical > .btn {
            position: relative;
            float: left;
        }
        .btn-group > .btn:hover,
        .btn-group-vertical > .btn:hover,
        .btn-group > .btn:focus,
        .btn-group-vertical > .btn:focus,
        .btn-group > .btn:active,
        .btn-group-vertical > .btn:active,
        .btn-group > .btn.active,
        .btn-group-vertical > .btn.active {
            z-index: 2;
        }
        .btn-group .btn + .btn,
        .btn-group .btn + .btn-group,
        .btn-group .btn-group + .btn,
        .btn-group .btn-group + .btn-group {
            margin-left: -1px;
        }
        .btn-toolbar {
            margin-left: -5px;
        }
        .btn-toolbar .btn,
        .btn-toolbar .btn-group,
        .btn-toolbar .input-group {
            float: left;
        }
        .btn-toolbar > .btn,
        .btn-toolbar > .btn-group,
        .btn-toolbar > .input-group {
            margin-left: 5px;
        }
        .btn-group > .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {
            border-radius: 0;
        }
        .btn-group > .btn:first-child {
            margin-left: 0;
        }
        .btn-group > .btn:first-child:not(:last-child):not(.dropdown-toggle) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .btn-group > .btn:last-child:not(:first-child),
        .btn-group > .dropdown-toggle:not(:first-child) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .btn-group > .btn-group {
            float: left;
        }
        .btn-group > .btn-group:not(:first-child):not(:last-child) > .btn {
            border-radius: 0;
        }
        .btn-group > .btn-group:first-child:not(:last-child) > .btn:last-child,
        .btn-group > .btn-group:first-child:not(:last-child) > .dropdown-toggle {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .btn-group > .btn-group:last-child:not(:first-child) > .btn:first-child {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .btn-group .dropdown-toggle:active,
        .btn-group.open .dropdown-toggle {
            outline: 0;
        }
        .btn-group > .btn + .dropdown-toggle {
            padding-right: 8px;
            padding-left: 8px;
        }
        .btn-group > .btn-lg + .dropdown-toggle {
            padding-right: 12px;
            padding-left: 12px;
        }
        .btn-group.open .dropdown-toggle {
            -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
        }
        .btn-group.open .dropdown-toggle.btn-link {
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .btn .caret {
            margin-left: 0;
        }
        .btn-lg .caret {
            border-width: 5px 5px 0;
            border-bottom-width: 0;
        }
        .dropup .btn-lg .caret {
            border-width: 0 5px 5px;
        }
        .btn-group-vertical > .btn,
        .btn-group-vertical > .btn-group,
        .btn-group-vertical > .btn-group > .btn {
            display: block;
            float: none;
            width: 100%;
            max-width: 100%;
        }
        .btn-group-vertical > .btn-group > .btn {
            float: none;
        }
        .btn-group-vertical > .btn + .btn,
        .btn-group-vertical > .btn + .btn-group,
        .btn-group-vertical > .btn-group + .btn,
        .btn-group-vertical > .btn-group + .btn-group {
            margin-top: -1px;
            margin-left: 0;
        }
        .btn-group-vertical > .btn:not(:first-child):not(:last-child) {
            border-radius: 0;
        }
        .btn-group-vertical > .btn:first-child:not(:last-child) {
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .btn-group-vertical > .btn:last-child:not(:first-child) {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .btn-group-vertical > .btn-group:not(:first-child):not(:last-child) > .btn {
            border-radius: 0;
        }
        .btn-group-vertical > .btn-group:first-child:not(:last-child) > .btn:last-child,
        .btn-group-vertical > .btn-group:first-child:not(:last-child) > .dropdown-toggle {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .btn-group-vertical > .btn-group:last-child:not(:first-child) > .btn:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .btn-group-justified {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-collapse: separate;
        }
        .btn-group-justified > .btn,
        .btn-group-justified > .btn-group {
            display: table-cell;
            float: none;
            width: 1%;
        }
        .btn-group-justified > .btn-group .btn {
            width: 100%;
        }
        .btn-group-justified > .btn-group .dropdown-menu {
            left: auto;
        }
        [data-toggle="buttons"] > .btn input[type="radio"],
        [data-toggle="buttons"] > .btn-group > .btn input[type="radio"],
        [data-toggle="buttons"] > .btn input[type="checkbox"],
        [data-toggle="buttons"] > .btn-group > .btn input[type="checkbox"] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
        }
        .input-group {
            position: relative;
            display: table;
            border-collapse: separate;
        }
        .input-group[class*="col-"] {
            float: none;
            padding-right: 0;
            padding-left: 0;
        }
        .input-group .form-control {
            position: relative;
            z-index: 2;
            float: left;
            width: 100%;
            margin-bottom: 0;
        }
        .input-group .form-control:focus {
            z-index: 3;
        }
        .input-group-lg > .form-control,
        .input-group-lg > .input-group-addon,
        .input-group-lg > .input-group-btn > .btn {
            height: 46px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
            border-radius: 6px;
        }
        select.input-group-lg > .form-control,
        select.input-group-lg > .input-group-addon,
        select.input-group-lg > .input-group-btn > .btn {
            height: 46px;
            line-height: 46px;
        }
        textarea.input-group-lg > .form-control,
        textarea.input-group-lg > .input-group-addon,
        textarea.input-group-lg > .input-group-btn > .btn,
        select[multiple].input-group-lg > .form-control,
        select[multiple].input-group-lg > .input-group-addon,
        select[multiple].input-group-lg > .input-group-btn > .btn {
            height: auto;
        }
        .input-group-sm > .form-control,
        .input-group-sm > .input-group-addon,
        .input-group-sm > .input-group-btn > .btn {
            height: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        select.input-group-sm > .form-control,
        select.input-group-sm > .input-group-addon,
        select.input-group-sm > .input-group-btn > .btn {
            height: 30px;
            line-height: 30px;
        }
        textarea.input-group-sm > .form-control,
        textarea.input-group-sm > .input-group-addon,
        textarea.input-group-sm > .input-group-btn > .btn,
        select[multiple].input-group-sm > .form-control,
        select[multiple].input-group-sm > .input-group-addon,
        select[multiple].input-group-sm > .input-group-btn > .btn {
            height: auto;
        }
        .input-group-addon,
        .input-group-btn,
        .input-group .form-control {
            display: table-cell;
        }
        .input-group-addon:not(:first-child):not(:last-child),
        .input-group-btn:not(:first-child):not(:last-child),
        .input-group .form-control:not(:first-child):not(:last-child) {
            border-radius: 0;
        }
        .input-group-addon,
        .input-group-btn {
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: normal;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .input-group-addon.input-sm {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 3px;
        }
        .input-group-addon.input-lg {
            padding: 10px 16px;
            font-size: 18px;
            border-radius: 6px;
        }
        .input-group-addon input[type="radio"],
        .input-group-addon input[type="checkbox"] {
            margin-top: 0;
        }
        .input-group .form-control:first-child,
        .input-group-addon:first-child,
        .input-group-btn:first-child > .btn,
        .input-group-btn:first-child > .btn-group > .btn,
        .input-group-btn:first-child > .dropdown-toggle,
        .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle),
        .input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .input-group-addon:first-child {
            border-right: 0;
        }
        .input-group .form-control:last-child,
        .input-group-addon:last-child,
        .input-group-btn:last-child > .btn,
        .input-group-btn:last-child > .btn-group > .btn,
        .input-group-btn:last-child > .dropdown-toggle,
        .input-group-btn:first-child > .btn:not(:first-child),
        .input-group-btn:first-child > .btn-group:not(:first-child) > .btn {

        }
        .input-group-addon:last-child {
            border-left: 0;
        }
        .input-group-btn {
            position: relative;
            font-size: 0;
            white-space: nowrap;
        }
        .input-group-btn > .btn {
            position: relative;
        }
        .input-group-btn > .btn + .btn {
            margin-left: -1px;
        }
        .input-group-btn > .btn:hover,
        .input-group-btn > .btn:focus,
        .input-group-btn > .btn:active {
            z-index: 2;
        }
        .input-group-btn:first-child > .btn,
        .input-group-btn:first-child > .btn-group {
            margin-right: -1px;
        }
        .input-group-btn:last-child > .btn,
        .input-group-btn:last-child > .btn-group {
            z-index: 2;
            margin-left: -1px;
        }
        .nav {
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }
        .nav > li {
            position: relative;
            display: block;
        }
        .nav > li > a {
            position: relative;
            display: block;
            padding: 10px 15px;
        }
        .nav > li > a:hover,
        .nav > li > a:focus {
            text-decoration: none;
            background-color: #eee;
        }
        .nav > li.disabled > a {
            color: #777;
        }
        .nav > li.disabled > a:hover,
        .nav > li.disabled > a:focus {
            color: #777;
            text-decoration: none;
            cursor: not-allowed;
            background-color: transparent;
        }
        .nav .open > a,
        .nav .open > a:hover,
        .nav .open > a:focus {
            background-color: #eee;
            border-color: #337ab7;
        }
        .nav .nav-divider {
            height: 1px;
            margin: 9px 0;
            overflow: hidden;
            background-color: #e5e5e5;
        }
        .nav > li > a > img {
            max-width: none;
        }
        .nav-tabs {
            direction: rtl;
            text-align: center;
        }
        .nav-tabs > li {
            display: inline-block;
            margin-bottom: -3px;
            text-align: center;
        }
        .nav-tabs > li > a {
            margin-right: 2px;
            line-height: 1.42857143;
            border: 1px solid transparent;
            border-radius: 4px 4px 0 0;
        }
        .nav-tabs > li > a:hover {
            border-color: #eee #eee #ddd;
        }
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:hover,
        .nav-tabs > li.active > a:focus {
            color: #555;
            cursor: default;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
        }
        .nav-tabs.nav-justified {
            width: 100%;
            border-bottom: 0;
        }
        .nav-tabs.nav-justified > li {
            float: none;
        }
        .nav-tabs.nav-justified > li > a {
            margin-bottom: 5px;
            text-align: center;
        }
        .nav-tabs.nav-justified > .dropdown .dropdown-menu {
            top: auto;
            left: auto;
        }
        @media (min-width: 768px) {
            .nav-tabs.nav-justified > li {
                display: table-cell;
                width: 1%;
            }
            .nav-tabs.nav-justified > li > a {
                margin-bottom: 0;
            }
        }
        .nav-tabs.nav-justified > li > a {
            margin-right: 0;
            border-radius: 4px;
        }
        .nav-tabs.nav-justified > .active > a,
        .nav-tabs.nav-justified > .active > a:hover,
        .nav-tabs.nav-justified > .active > a:focus {
            border: 1px solid #ddd;
        }
        @media (min-width: 768px) {
            .nav-tabs.nav-justified > li > a {
                border-bottom: 1px solid #ddd;
                border-radius: 4px 4px 0 0;
            }
            .nav-tabs.nav-justified > .active > a,
            .nav-tabs.nav-justified > .active > a:hover,
            .nav-tabs.nav-justified > .active > a:focus {
                border-bottom-color: #fff;
            }
        }
        .nav-pills > li {
            float: left;
        }
        .nav-pills > li > a {
            border-radius: 4px;
        }
        .nav-pills > li + li {
            margin-left: 2px;
        }
        .nav-pills > li.active > a,
        .nav-pills > li.active > a:hover,
        .nav-pills > li.active > a:focus {
            color: #fff;
            background-color: #337ab7;
        }
        .nav-stacked > li {
            float: none;
        }
        .nav-stacked > li + li {
            margin-top: 2px;
            margin-left: 0;
        }
        .nav-justified {
            width: 100%;
        }
        .nav-justified > li {
            float: none;
        }
        .nav-justified > li > a {
            margin-bottom: 5px;
            text-align: center;
        }
        .nav-justified > .dropdown .dropdown-menu {
            top: auto;
            left: auto;
        }
        @media (min-width: 768px) {
            .nav-justified > li {
                display: table-cell;
                width: 1%;
            }
            .nav-justified > li > a {
                margin-bottom: 0;
            }
        }
        .nav-tabs-justified {
            border-bottom: 0;
        }
        .nav-tabs-justified > li > a {
            margin-right: 0;
            border-radius: 4px;
        }
        .nav-tabs-justified > .active > a,
        .nav-tabs-justified > .active > a:hover,
        .nav-tabs-justified > .active > a:focus {
            border: 1px solid #ddd;
        }
        @media (min-width: 768px) {
            .nav-tabs-justified > li > a {
                border-bottom: 1px solid #ddd;
                border-radius: 4px 4px 0 0;
            }
            .nav-tabs-justified > .active > a,
            .nav-tabs-justified > .active > a:hover,
            .nav-tabs-justified > .active > a:focus {
                border-bottom-color: #fff;
            }
        }
        .tab-content > .tab-pane {
            display: none;
        }
        .tab-content > .active {
            display: block;
        }
        .nav-tabs .dropdown-menu {
            margin-top: -1px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .navbar {
            position: relative;
            min-height: 50px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        @media (min-width: 768px) {
            .navbar {
                border-radius: 4px;
            }
        }
        @media (min-width: 768px) {
            .navbar-header {
                float: left;
            }
        }
        .navbar-collapse {
            padding-right: 15px;
            padding-left: 15px;
            overflow-x: visible;
            -webkit-overflow-scrolling: touch;
            border-top: 1px solid transparent;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
        }
        .navbar-collapse.in {
            overflow-y: auto;
        }
        @media (min-width: 768px) {
            .navbar-collapse {
                width: auto;
                border-top: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
            }
            .navbar-collapse.collapse {
                display: block !important;
                height: auto !important;
                padding-bottom: 0;
                overflow: visible !important;
            }
            .navbar-collapse.in {
                overflow-y: visible;
            }
            .navbar-fixed-top .navbar-collapse,
            .navbar-static-top .navbar-collapse,
            .navbar-fixed-bottom .navbar-collapse {
                padding-right: 0;
                padding-left: 0;
            }
        }
        .navbar-fixed-top .navbar-collapse,
        .navbar-fixed-bottom .navbar-collapse {
            max-height: 340px;
        }
        @media (max-device-width: 480px) and (orientation: landscape) {
            .navbar-fixed-top .navbar-collapse,
            .navbar-fixed-bottom .navbar-collapse {
                max-height: 200px;
            }
        }
        .container > .navbar-header,
        .container-fluid > .navbar-header,
        .container > .navbar-collapse,
        .container-fluid > .navbar-collapse {
            margin-right: -15px;
            margin-left: -15px;
        }
        @media (min-width: 768px) {
            .container > .navbar-header,
            .container-fluid > .navbar-header,
            .container > .navbar-collapse,
            .container-fluid > .navbar-collapse {
                margin-right: 0;
                margin-left: 0;
            }
        }
        .navbar-static-top {
            z-index: 1000;
            border-width: 0 0 1px;
        }
        @media (min-width: 768px) {
            .navbar-static-top {
                border-radius: 0;
            }
        }
        .navbar-fixed-top,
        .navbar-fixed-bottom {
            position: fixed;
            right: 0;
            left: 0;
            z-index: 1030;
        }
        @media (min-width: 768px) {
            .navbar-fixed-top,
            .navbar-fixed-bottom {
                border-radius: 0;
            }
        }
        .navbar-fixed-top {
            top: 0;
            border-width: 0 0 1px;
        }
        .navbar-fixed-bottom {
            bottom: 0;
            margin-bottom: 0;
            border-width: 1px 0 0;
        }
        .navbar-brand {
            float: left;
            height: 50px;
            padding: 15px 15px;
            font-size: 18px;
            line-height: 20px;
        }
        .navbar-brand:hover,
        .navbar-brand:focus {
            text-decoration: none;
        }
        .navbar-brand > img {
            display: block;
        }
        @media (min-width: 768px) {
            .navbar > .container .navbar-brand,
            .navbar > .container-fluid .navbar-brand {
                margin-left: -15px;
            }
        }
        .navbar-toggle {
            position: relative;
            float: right;
            padding: 9px 10px;
            margin-top: 8px;
            margin-right: 15px;
            margin-bottom: 8px;
            background-color: transparent;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .navbar-toggle:focus {
            outline: 0;
        }
        .navbar-toggle .icon-bar {
            display: block;
            width: 22px;
            height: 2px;
            border-radius: 1px;
        }
        .navbar-toggle .icon-bar + .icon-bar {
            margin-top: 4px;
        }
        @media (min-width: 768px) {
            .navbar-toggle {
                display: none;
            }
        }
        .navbar-nav {
            margin: 7.5px -15px;
        }
        .navbar-nav > li > a {
            padding-top: 10px;
            padding-bottom: 10px;
            line-height: 20px;
        }
        @media (max-width: 767px) {
            .navbar-nav .open .dropdown-menu {
                position: static;
                float: none;
                width: auto;
                margin-top: 0;
                background-color: transparent;
                border: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
            }
            .navbar-nav .open .dropdown-menu > li > a,
            .navbar-nav .open .dropdown-menu .dropdown-header {
                padding: 5px 15px 5px 25px;
            }
            .navbar-nav .open .dropdown-menu > li > a {
                line-height: 20px;
            }
            .navbar-nav .open .dropdown-menu > li > a:hover,
            .navbar-nav .open .dropdown-menu > li > a:focus {
                background-image: none;
            }
        }
        @media (min-width: 768px) {
            .navbar-nav {
                float: left;
                margin: 0;
            }
            .navbar-nav > li {
                float: left;
            }
            .navbar-nav > li > a {
                padding-top: 15px;
                padding-bottom: 15px;
            }
        }
        .navbar-form {
            padding: 10px 15px;
            margin-top: 8px;
            margin-right: -15px;
            margin-bottom: 8px;
            margin-left: -15px;
            border-top: 1px solid transparent;
            border-bottom: 1px solid transparent;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1), 0 1px 0 rgba(255, 255, 255, .1);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1), 0 1px 0 rgba(255, 255, 255, .1);
        }
        @media (min-width: 768px) {
            .navbar-form .form-group {
                display: inline-block;
                margin-bottom: 0;
                vertical-align: middle;
            }
            .navbar-form .form-control {
                display: inline-block;
                width: auto;
                vertical-align: middle;
            }
            .navbar-form .form-control-static {
                display: inline-block;
            }
            .navbar-form .input-group {
                display: inline-table;
                vertical-align: middle;
            }
            .navbar-form .input-group .input-group-addon,
            .navbar-form .input-group .input-group-btn,
            .navbar-form .input-group .form-control {
                width: auto;
            }
            .navbar-form .input-group > .form-control {
                width: 100%;
            }
            .navbar-form .control-label {
                margin-bottom: 0;
                vertical-align: middle;
            }
            .navbar-form .radio,
            .navbar-form .checkbox {
                display: inline-block;
                margin-top: 0;
                margin-bottom: 0;
                vertical-align: middle;
            }
            .navbar-form .radio label,
            .navbar-form .checkbox label {
                padding-left: 0;
            }
            .navbar-form .radio input[type="radio"],
            .navbar-form .checkbox input[type="checkbox"] {
                position: relative;
                margin-left: 0;
            }
            .navbar-form .has-feedback .form-control-feedback {
                top: 0;
            }
        }
        @media (max-width: 767px) {
            .navbar-form .form-group {
                margin-bottom: 5px;
            }
            .navbar-form .form-group:last-child {
                margin-bottom: 0;
            }
        }
        @media (min-width: 768px) {
            .navbar-form {
                width: auto;
                padding-top: 0;
                padding-bottom: 0;
                margin-right: 0;
                margin-left: 0;
                border: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
            }
        }
        .navbar-nav > li > .dropdown-menu {
            margin-top: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .navbar-fixed-bottom .navbar-nav > li > .dropdown-menu {
            margin-bottom: 0;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .navbar-btn {
            margin-top: 8px;
            margin-bottom: 8px;
        }
        .navbar-btn.btn-sm {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .navbar-btn.btn-xs {
            margin-top: 14px;
            margin-bottom: 14px;
        }
        .navbar-text {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        @media (min-width: 768px) {
            .navbar-text {
                float: left;
                margin-right: 15px;
                margin-left: 15px;
            }
        }
        @media (min-width: 768px) {
            .navbar-left {
                float: left !important;
            }
            .navbar-right {
                float: right !important;
                margin-right: -15px;
            }
            .navbar-right ~ .navbar-right {
                margin-right: 0;
            }
        }
        .navbar-default {
            background-color: #f8f8f8;
            border-color: #e7e7e7;
        }
        .navbar-default .navbar-brand {
            color: #777;
        }
        .navbar-default .navbar-brand:hover,
        .navbar-default .navbar-brand:focus {
            color: #5e5e5e;
            background-color: transparent;
        }
        .navbar-default .navbar-text {
            color: #777;
        }
        .navbar-default .navbar-nav > li > a {
            color: #777;
        }
        .navbar-default .navbar-nav > li > a:hover,
        .navbar-default .navbar-nav > li > a:focus {
            color: #333;
            background-color: transparent;
        }
        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus {
            color: #555;
            background-color: #e7e7e7;
        }
        .navbar-default .navbar-nav > .disabled > a,
        .navbar-default .navbar-nav > .disabled > a:hover,
        .navbar-default .navbar-nav > .disabled > a:focus {
            color: #ccc;
            background-color: transparent;
        }
        .navbar-default .navbar-toggle {
            border-color: #ddd;
        }
        .navbar-default .navbar-toggle:hover,
        .navbar-default .navbar-toggle:focus {
            background-color: #ddd;
        }
        .navbar-default .navbar-toggle .icon-bar {
            background-color: #888;
        }
        .navbar-default .navbar-collapse,
        .navbar-default .navbar-form {
            border-color: #e7e7e7;
        }
        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
            color: #555;
            background-color: #e7e7e7;
        }
        @media (max-width: 767px) {
            .navbar-default .navbar-nav .open .dropdown-menu > li > a {
                color: #777;
            }
            .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
            .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
                color: #333;
                background-color: transparent;
            }
            .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
            .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
            .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
                color: #555;
                background-color: #e7e7e7;
            }
            .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a,
            .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a:hover,
            .navbar-default .navbar-nav .open .dropdown-menu > .disabled > a:focus {
                color: #ccc;
                background-color: transparent;
            }
        }
        .navbar-default .navbar-link {
            color: #777;
        }
        .navbar-default .navbar-link:hover {
            color: #333;
        }
        .navbar-default .btn-link {
            color: #777;
        }
        .navbar-default .btn-link:hover,
        .navbar-default .btn-link:focus {
            color: #333;
        }
        .navbar-default .btn-link[disabled]:hover,
        fieldset[disabled] .navbar-default .btn-link:hover,
        .navbar-default .btn-link[disabled]:focus,
        fieldset[disabled] .navbar-default .btn-link:focus {
            color: #ccc;
        }
        .navbar-inverse {
            background-color: #222;
            border-color: #080808;
        }
        .navbar-inverse .navbar-brand {
            color: #9d9d9d;
        }
        .navbar-inverse .navbar-brand:hover,
        .navbar-inverse .navbar-brand:focus {
            color: #fff;
            background-color: transparent;
        }
        .navbar-inverse .navbar-text {
            color: #9d9d9d;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: #9d9d9d;
        }
        .navbar-inverse .navbar-nav > li > a:hover,
        .navbar-inverse .navbar-nav > li > a:focus {
            color: #fff;
            background-color: transparent;
        }
        .navbar-inverse .navbar-nav > .active > a,
        .navbar-inverse .navbar-nav > .active > a:hover,
        .navbar-inverse .navbar-nav > .active > a:focus {
            color: #fff;
            background-color: #080808;
        }
        .navbar-inverse .navbar-nav > .disabled > a,
        .navbar-inverse .navbar-nav > .disabled > a:hover,
        .navbar-inverse .navbar-nav > .disabled > a:focus {
            color: #444;
            background-color: transparent;
        }
        .navbar-inverse .navbar-toggle {
            border-color: #333;
        }
        .navbar-inverse .navbar-toggle:hover,
        .navbar-inverse .navbar-toggle:focus {
            background-color: #333;
        }
        .navbar-inverse .navbar-toggle .icon-bar {
            background-color: #fff;
        }
        .navbar-inverse .navbar-collapse,
        .navbar-inverse .navbar-form {
            border-color: #101010;
        }
        .navbar-inverse .navbar-nav > .open > a,
        .navbar-inverse .navbar-nav > .open > a:hover,
        .navbar-inverse .navbar-nav > .open > a:focus {
            color: #fff;
            background-color: #080808;
        }
        @media (max-width: 767px) {
            .navbar-inverse .navbar-nav .open .dropdown-menu > .dropdown-header {
                border-color: #080808;
            }
            .navbar-inverse .navbar-nav .open .dropdown-menu .divider {
                background-color: #080808;
            }
            .navbar-inverse .navbar-nav .open .dropdown-menu > li > a {
                color: #9d9d9d;
            }
            .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover,
            .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus {
                color: #fff;
                background-color: transparent;
            }
            .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a,
            .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:hover,
            .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:focus {
                color: #fff;
                background-color: #080808;
            }
            .navbar-inverse .navbar-nav .open .dropdown-menu > .disabled > a,
            .navbar-inverse .navbar-nav .open .dropdown-menu > .disabled > a:hover,
            .navbar-inverse .navbar-nav .open .dropdown-menu > .disabled > a:focus {
                color: #444;
                background-color: transparent;
            }
        }
        .navbar-inverse .navbar-link {
            color: #9d9d9d;
        }
        .navbar-inverse .navbar-link:hover {
            color: #fff;
        }
        .navbar-inverse .btn-link {
            color: #9d9d9d;
        }
        .navbar-inverse .btn-link:hover,
        .navbar-inverse .btn-link:focus {
            color: #fff;
        }
        .navbar-inverse .btn-link[disabled]:hover,
        fieldset[disabled] .navbar-inverse .btn-link:hover,
        .navbar-inverse .btn-link[disabled]:focus,
        fieldset[disabled] .navbar-inverse .btn-link:focus {
            color: #444;
        }
        .breadcrumb {
            padding: 8px 15px;
            margin-bottom: 20px;
            list-style: none;
            background-color: #f5f5f5;
            border-radius: 4px;
        }
        .breadcrumb > li {
            display: inline-block;
        }
        .breadcrumb > li + li:before {
            padding: 0 5px;
            color: #ccc;
            content: "/\00a0";
        }
        .breadcrumb > .active {
            color: #777;
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            margin:0px 5px;
            line-height: 35px;
            color: #fff;
            text-decoration: none;
            background-color: #959595;
            border: 1px solid #959595;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            height: 35px;
            width: 35px;
            font-weight: 500;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            z-index: 2;
            color: #fff;
            background-color: #ff8c41;
            border-color: #ff8c41;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .pagination-lg > li > a,
        .pagination-lg > li > span {
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
        }
        .pagination-lg > li:first-child > a,
        .pagination-lg > li:first-child > span {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }
        .pagination-lg > li:last-child > a,
        .pagination-lg > li:last-child > span {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }
        .pagination-sm > li > a,
        .pagination-sm > li > span {
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
        }
        .pagination-sm > li:first-child > a,
        .pagination-sm > li:first-child > span {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        .pagination-sm > li:last-child > a,
        .pagination-sm > li:last-child > span {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }
        .pager {
            padding-left: 0;
            margin: 20px 0;
            text-align: center;
            list-style: none;
        }
        .pager li {
            display: inline;
        }
        .pager li > a,
        .pager li > span {
            display: inline-block;
            padding: 5px 14px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px;
        }
        .pager li > a:hover,
        .pager li > a:focus {
            text-decoration: none;
            background-color: #eee;
        }
        .pager .next > a,
        .pager .next > span {
            float: right;
        }
        .pager .previous > a,
        .pager .previous > span {
            float: left;
        }
        .pager .disabled > a,
        .pager .disabled > a:hover,
        .pager .disabled > a:focus,
        .pager .disabled > span {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
        }
        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: bold;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }
        a.label:hover,
        a.label:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }
        .label:empty {
            display: none;
        }
        .btn .label {
            position: relative;
            top: -1px;
        }
        .label-default {
            background-color: #777;
        }
        .label-default[href]:hover,
        .label-default[href]:focus {
            background-color: #5e5e5e;
        }
        .label-primary {
            background-color: #337ab7;
        }
        .label-primary[href]:hover,
        .label-primary[href]:focus {
            background-color: #286090;
        }
        .label-success {
            background-color: #5cb85c;
        }
        .label-success[href]:hover,
        .label-success[href]:focus {
            background-color: #449d44;
        }
        .label-info {
            background-color: #5bc0de;
        }
        .label-info[href]:hover,
        .label-info[href]:focus {
            background-color: #31b0d5;
        }
        .label-warning {
            background-color: #f0ad4e;
        }
        .label-warning[href]:hover,
        .label-warning[href]:focus {
            background-color: #ec971f;
        }
        .label-danger {
            background-color: #d9534f;
        }
        .label-danger[href]:hover,
        .label-danger[href]:focus {
            background-color: #c9302c;
        }
        .badge {
            display: inline-block;
            min-width: 10px;
            padding: 3px 7px;
            font-size: 12px;
            font-weight: bold;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            background-color: #777;
            border-radius: 10px;
        }
        .badge:empty {
            display: none;
        }
        .btn .badge {
            position: relative;
            top: -1px;
        }
        .btn-xs .badge,
        .btn-group-xs > .btn .badge {
            top: 0;
            padding: 1px 5px;
        }
        a.badge:hover,
        a.badge:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }
        .list-group-item.active > .badge,
        .nav-pills > .active > a > .badge {
            color: #337ab7;
            background-color: #fff;
        }
        .list-group-item > .badge {
            float: right;
        }
        .list-group-item > .badge + .badge {
            margin-right: 5px;
        }
        .nav-pills > li > a > .badge {
            margin-left: 3px;
        }
        .jumbotron {
            padding-top: 30px;
            padding-bottom: 30px;
            margin-bottom: 30px;
            color: inherit;
            background-color: #eee;
        }
        .jumbotron h1,
        .jumbotron .h1 {
            color: inherit;
        }
        .jumbotron p {
            margin-bottom: 15px;
            font-size: 21px;
            font-weight: 200;
        }
        .jumbotron > hr {
            border-top-color: #d5d5d5;
        }
        .container .jumbotron,
        .container-fluid .jumbotron {
            padding-right: 15px;
            padding-left: 15px;
            border-radius: 6px;
        }
        .jumbotron .container {
            max-width: 100%;
        }
        @media screen and (min-width: 768px) {
            .jumbotron {
                padding-top: 48px;
                padding-bottom: 48px;
            }
            .container .jumbotron,
            .container-fluid .jumbotron {
                padding-right: 60px;
                padding-left: 60px;
            }
            .jumbotron h1,
            .jumbotron .h1 {
                font-size: 63px;
            }
        }
        .thumbnail {
            display: block;
            padding: 4px;
            margin-bottom: 20px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: border .2s ease-in-out;
            -o-transition: border .2s ease-in-out;
            transition: border .2s ease-in-out;
        }
        .thumbnail > img,
        .thumbnail a > img {
            margin-right: auto;
            margin-left: auto;
        }
        a.thumbnail:hover,
        a.thumbnail:focus,
        a.thumbnail.active {
            border-color: #337ab7;
        }
        .thumbnail .caption {
            padding: 9px;
            color: #333;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert h4 {
            margin-top: 0;
            color: inherit;
        }
        .alert .alert-link {
            font-weight: bold;
        }
        .alert > p,
        .alert > ul {
            margin-bottom: 0;
        }
        .alert > p + p {
            margin-top: 5px;
        }
        .alert-dismissable,
        .alert-dismissible {
            padding-right: 35px;
        }
        .alert-dismissable .close,
        .alert-dismissible .close {
            position: relative;
            top: -2px;
            right: -21px;
            color: inherit;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert-success hr {
            border-top-color: #c9e2b3;
        }
        .alert-success .alert-link {
            color: #2b542c;
        }
        .alert-info {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
        .alert-info hr {
            border-top-color: #a6e1ec;
        }
        .alert-info .alert-link {
            color: #245269;
        }
        .alert-warning {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
        }
        .alert-warning hr {
            border-top-color: #f7e1b5;
        }
        .alert-warning .alert-link {
            color: #66512c;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .alert-danger hr {
            border-top-color: #e4b9c0;
        }
        .alert-danger .alert-link {
            color: #843534;
        }
        @-webkit-keyframes progress-bar-stripes {
            from {
                background-position: 40px 0;
            }
            to {
                background-position: 0 0;
            }
        }
        @-o-keyframes progress-bar-stripes {
            from {
                background-position: 40px 0;
            }
            to {
                background-position: 0 0;
            }
        }
        @keyframes progress-bar-stripes {
            from {
                background-position: 40px 0;
            }
            to {
                background-position: 0 0;
            }
        }
        .progress {
            height: 15px;
            margin-bottom: 15px;
            overflow: hidden;
            background-color: #fff;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        }
        .progress-bar {
            float: right;
            width: 0;
            height: 100%;
            font-size: 12px;
            line-height: 20px;
            color: #fff;
            text-align: center;
            background-color: #337ab7;
            -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
            -webkit-transition: width .6s ease;
            -o-transition: width .6s ease;
            transition: width .6s ease;
        }
        .progress-striped .progress-bar,
        .progress-bar-striped {
            background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            -webkit-background-size: 40px 40px;
            background-size: 40px 40px;
        }
        .progress.active .progress-bar,
        .progress-bar.active {
            -webkit-animation: progress-bar-stripes 2s linear infinite;
            -o-animation: progress-bar-stripes 2s linear infinite;
            animation: progress-bar-stripes 2s linear infinite;
        }
        .progress-bar-success {
            background-color: #5cb85c;
        }
        .progress-striped .progress-bar-success {
            background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
        }
        .progress-bar-info {
            background-color: #5bc0de;
        }
        .progress-striped .progress-bar-info {
            background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
        }
        .progress-bar-warning {
            background-color: #f0ad4e;
        }
        .progress-striped .progress-bar-warning {
            background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
        }
        .progress-bar-danger {
            background-color: #d9534f;
        }
        .progress-striped .progress-bar-danger {
            background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
        }
        .media {
            margin-top: 15px;
        }
        .media:first-child {
            margin-top: 0;
        }
        .media,
        .media-body {
            overflow: hidden;
            zoom: 1;
        }
        .media-body {
            width: 10000px;
        }
        .media-object {
            display: block;
        }
        .media-object.img-thumbnail {
            max-width: none;
        }
        .media-right,
        .media > .pull-right {
            padding-left: 10px;
        }
        .media-left,
        .media > .pull-left {
            padding-right: 10px;
        }
        .media-left,
        .media-right,
        .media-body {
            display: table-cell;
            vertical-align: top;
        }
        .media-middle {
            vertical-align: middle;
        }
        .media-bottom {
            vertical-align: bottom;
        }
        .media-heading {
            margin-top: 0;
            margin-bottom: 5px;
        }
        .media-list {
            padding-left: 0;
            list-style: none;
        }
        .list-group {
            padding-left: 0;
            margin-bottom: 20px;
        }
        .list-group-item {
            position: relative;
            display: block;
            padding: 10px 15px;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .list-group-item:first-child {
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        .list-group-item:last-child {
            margin-bottom: 0;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        a.list-group-item,
        button.list-group-item {
            color: #555;
        }
        a.list-group-item .list-group-item-heading,
        button.list-group-item .list-group-item-heading {
            color: #333;
        }
        a.list-group-item:hover,
        button.list-group-item:hover,
        a.list-group-item:focus,
        button.list-group-item:focus {
            color: #555;
            text-decoration: none;
            background-color: #f5f5f5;
        }
        button.list-group-item {
            width: 100%;
            text-align: left;
        }
        .list-group-item.disabled,
        .list-group-item.disabled:hover,
        .list-group-item.disabled:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #eee;
        }
        .list-group-item.disabled .list-group-item-heading,
        .list-group-item.disabled:hover .list-group-item-heading,
        .list-group-item.disabled:focus .list-group-item-heading {
            color: inherit;
        }
        .list-group-item.disabled .list-group-item-text,
        .list-group-item.disabled:hover .list-group-item-text,
        .list-group-item.disabled:focus .list-group-item-text {
            color: #777;
        }
        .list-group-item.active,
        .list-group-item.active:hover,
        .list-group-item.active:focus {
            z-index: 2;
            color: #fff;
            background-color: #337ab7;
            border-color: #337ab7;
        }
        .list-group-item.active .list-group-item-heading,
        .list-group-item.active:hover .list-group-item-heading,
        .list-group-item.active:focus .list-group-item-heading,
        .list-group-item.active .list-group-item-heading > small,
        .list-group-item.active:hover .list-group-item-heading > small,
        .list-group-item.active:focus .list-group-item-heading > small,
        .list-group-item.active .list-group-item-heading > .small,
        .list-group-item.active:hover .list-group-item-heading > .small,
        .list-group-item.active:focus .list-group-item-heading > .small {
            color: inherit;
        }
        .list-group-item.active .list-group-item-text,
        .list-group-item.active:hover .list-group-item-text,
        .list-group-item.active:focus .list-group-item-text {
            color: #c7ddef;
        }
        .list-group-item-success {
            color: #3c763d;
            background-color: #dff0d8;
        }
        a.list-group-item-success,
        button.list-group-item-success {
            color: #3c763d;
        }
        a.list-group-item-success .list-group-item-heading,
        button.list-group-item-success .list-group-item-heading {
            color: inherit;
        }
        a.list-group-item-success:hover,
        button.list-group-item-success:hover,
        a.list-group-item-success:focus,
        button.list-group-item-success:focus {
            color: #3c763d;
            background-color: #d0e9c6;
        }
        a.list-group-item-success.active,
        button.list-group-item-success.active,
        a.list-group-item-success.active:hover,
        button.list-group-item-success.active:hover,
        a.list-group-item-success.active:focus,
        button.list-group-item-success.active:focus {
            color: #fff;
            background-color: #3c763d;
            border-color: #3c763d;
        }
        .list-group-item-info {
            color: #31708f;
            background-color: #d9edf7;
        }
        a.list-group-item-info,
        button.list-group-item-info {
            color: #31708f;
        }
        a.list-group-item-info .list-group-item-heading,
        button.list-group-item-info .list-group-item-heading {
            color: inherit;
        }
        a.list-group-item-info:hover,
        button.list-group-item-info:hover,
        a.list-group-item-info:focus,
        button.list-group-item-info:focus {
            color: #31708f;
            background-color: #c4e3f3;
        }
        a.list-group-item-info.active,
        button.list-group-item-info.active,
        a.list-group-item-info.active:hover,
        button.list-group-item-info.active:hover,
        a.list-group-item-info.active:focus,
        button.list-group-item-info.active:focus {
            color: #fff;
            background-color: #31708f;
            border-color: #31708f;
        }
        .list-group-item-warning {
            color: #8a6d3b;
            background-color: #fcf8e3;
        }
        a.list-group-item-warning,
        button.list-group-item-warning {
            color: #8a6d3b;
        }
        a.list-group-item-warning .list-group-item-heading,
        button.list-group-item-warning .list-group-item-heading {
            color: inherit;
        }
        a.list-group-item-warning:hover,
        button.list-group-item-warning:hover,
        a.list-group-item-warning:focus,
        button.list-group-item-warning:focus {
            color: #8a6d3b;
            background-color: #faf2cc;
        }
        a.list-group-item-warning.active,
        button.list-group-item-warning.active,
        a.list-group-item-warning.active:hover,
        button.list-group-item-warning.active:hover,
        a.list-group-item-warning.active:focus,
        button.list-group-item-warning.active:focus {
            color: #fff;
            background-color: #8a6d3b;
            border-color: #8a6d3b;
        }
        .list-group-item-danger {
            color: #a94442;
            background-color: #f2dede;
        }
        a.list-group-item-danger,
        button.list-group-item-danger {
            color: #a94442;
        }
        a.list-group-item-danger .list-group-item-heading,
        button.list-group-item-danger .list-group-item-heading {
            color: inherit;
        }
        a.list-group-item-danger:hover,
        button.list-group-item-danger:hover,
        a.list-group-item-danger:focus,
        button.list-group-item-danger:focus {
            color: #a94442;
            background-color: #ebcccc;
        }
        a.list-group-item-danger.active,
        button.list-group-item-danger.active,
        a.list-group-item-danger.active:hover,
        button.list-group-item-danger.active:hover,
        a.list-group-item-danger.active:focus,
        button.list-group-item-danger.active:focus {
            color: #fff;
            background-color: #a94442;
            border-color: #a94442;
        }
        .list-group-item-heading {
            margin-top: 0;
            margin-bottom: 5px;
        }
        .list-group-item-text {
            margin-bottom: 0;
            line-height: 1.3;
        }
        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
        }
        .panel-body {
            padding: 15px;
        }
        .panel-heading {
            padding: 5px 0;
            border-bottom: 1px solid transparent;
        }
        .panel-heading > .dropdown .dropdown-toggle {
            color: inherit;
        }
        .panel-title {
            color: inherit;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 0;
            margin-top: 0;
            text-align: right;
        }
        .panel-title > a,
        .panel-title > small,
        .panel-title > .small,
        .panel-title > small > a,
        .panel-title > .small > a {
            color: inherit;
        }
        .panel-footer {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        .panel > .list-group,
        .panel > .panel-collapse > .list-group {
            margin-bottom: 0;
        }
        .panel > .list-group .list-group-item,
        .panel > .panel-collapse > .list-group .list-group-item {
            border-width: 1px 0;
            border-radius: 0;
        }
        .panel > .list-group:first-child .list-group-item:first-child,
        .panel > .panel-collapse > .list-group:first-child .list-group-item:first-child {
            border-top: 0;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }
        .panel > .list-group:last-child .list-group-item:last-child,
        .panel > .panel-collapse > .list-group:last-child .list-group-item:last-child {
            border-bottom: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        .panel > .panel-heading + .panel-collapse > .list-group .list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .panel-heading + .list-group .list-group-item:first-child {
            border-top-width: 0;
        }
        .list-group + .panel-footer {
            border-top-width: 0;
        }
        .panel > .table,
        .panel > .table-responsive > .table,
        .panel > .panel-collapse > .table {
            margin-bottom: 0;
        }
        .panel > .table caption,
        .panel > .table-responsive > .table caption,
        .panel > .panel-collapse > .table caption {
            padding-right: 15px;
            padding-left: 15px;
        }
        .panel > .table:first-child,
        .panel > .table-responsive:first-child > .table:first-child {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }
        .panel > .table:first-child > thead:first-child > tr:first-child,
        .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child,
        .panel > .table:first-child > tbody:first-child > tr:first-child,
        .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }
        .panel > .table:first-child > thead:first-child > tr:first-child td:first-child,
        .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child td:first-child,
        .panel > .table:first-child > tbody:first-child > tr:first-child td:first-child,
        .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child td:first-child,
        .panel > .table:first-child > thead:first-child > tr:first-child th:first-child,
        .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child th:first-child,
        .panel > .table:first-child > tbody:first-child > tr:first-child th:first-child,
        .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child th:first-child {
            border-top-left-radius: 3px;
        }
        .panel > .table:first-child > thead:first-child > tr:first-child td:last-child,
        .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child td:last-child,
        .panel > .table:first-child > tbody:first-child > tr:first-child td:last-child,
        .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child td:last-child,
        .panel > .table:first-child > thead:first-child > tr:first-child th:last-child,
        .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child th:last-child,
        .panel > .table:first-child > tbody:first-child > tr:first-child th:last-child,
        .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child th:last-child {
            border-top-right-radius: 3px;
        }
        .panel > .table:last-child,
        .panel > .table-responsive:last-child > .table:last-child {
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        .panel > .table:last-child > tbody:last-child > tr:last-child,
        .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child,
        .panel > .table:last-child > tfoot:last-child > tr:last-child,
        .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child {
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        .panel > .table:last-child > tbody:last-child > tr:last-child td:first-child,
        .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child td:first-child,
        .panel > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
        .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
        .panel > .table:last-child > tbody:last-child > tr:last-child th:first-child,
        .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child th:first-child,
        .panel > .table:last-child > tfoot:last-child > tr:last-child th:first-child,
        .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child th:first-child {
            border-bottom-left-radius: 3px;
        }
        .panel > .table:last-child > tbody:last-child > tr:last-child td:last-child,
        .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child td:last-child,
        .panel > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
        .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
        .panel > .table:last-child > tbody:last-child > tr:last-child th:last-child,
        .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child th:last-child,
        .panel > .table:last-child > tfoot:last-child > tr:last-child th:last-child,
        .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child th:last-child {
            border-bottom-right-radius: 3px;
        }
        .panel > .panel-body + .table,
        .panel > .panel-body + .table-responsive,
        .panel > .table + .panel-body,
        .panel > .table-responsive + .panel-body {
            border-top: 1px solid #ddd;
        }
        .panel > .table > tbody:first-child > tr:first-child th,
        .panel > .table > tbody:first-child > tr:first-child td {
            border-top: 0;
        }
        .panel > .table-bordered,
        .panel > .table-responsive > .table-bordered {
            border: 0;
        }
        .panel > .table-bordered > thead > tr > th:first-child,
        .panel > .table-responsive > .table-bordered > thead > tr > th:first-child,
        .panel > .table-bordered > tbody > tr > th:first-child,
        .panel > .table-responsive > .table-bordered > tbody > tr > th:first-child,
        .panel > .table-bordered > tfoot > tr > th:first-child,
        .panel > .table-responsive > .table-bordered > tfoot > tr > th:first-child,
        .panel > .table-bordered > thead > tr > td:first-child,
        .panel > .table-responsive > .table-bordered > thead > tr > td:first-child,
        .panel > .table-bordered > tbody > tr > td:first-child,
        .panel > .table-responsive > .table-bordered > tbody > tr > td:first-child,
        .panel > .table-bordered > tfoot > tr > td:first-child,
        .panel > .table-responsive > .table-bordered > tfoot > tr > td:first-child {
            border-left: 0;
        }
        .panel > .table-bordered > thead > tr > th:last-child,
        .panel > .table-responsive > .table-bordered > thead > tr > th:last-child,
        .panel > .table-bordered > tbody > tr > th:last-child,
        .panel > .table-responsive > .table-bordered > tbody > tr > th:last-child,
        .panel > .table-bordered > tfoot > tr > th:last-child,
        .panel > .table-responsive > .table-bordered > tfoot > tr > th:last-child,
        .panel > .table-bordered > thead > tr > td:last-child,
        .panel > .table-responsive > .table-bordered > thead > tr > td:last-child,
        .panel > .table-bordered > tbody > tr > td:last-child,
        .panel > .table-responsive > .table-bordered > tbody > tr > td:last-child,
        .panel > .table-bordered > tfoot > tr > td:last-child,
        .panel > .table-responsive > .table-bordered > tfoot > tr > td:last-child {
            border-right: 0;
        }
        .panel > .table-bordered > thead > tr:first-child > td,
        .panel > .table-responsive > .table-bordered > thead > tr:first-child > td,
        .panel > .table-bordered > tbody > tr:first-child > td,
        .panel > .table-responsive > .table-bordered > tbody > tr:first-child > td,
        .panel > .table-bordered > thead > tr:first-child > th,
        .panel > .table-responsive > .table-bordered > thead > tr:first-child > th,
        .panel > .table-bordered > tbody > tr:first-child > th,
        .panel > .table-responsive > .table-bordered > tbody > tr:first-child > th {
            border-bottom: 0;
        }
        .panel > .table-bordered > tbody > tr:last-child > td,
        .panel > .table-responsive > .table-bordered > tbody > tr:last-child > td,
        .panel > .table-bordered > tfoot > tr:last-child > td,
        .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > td,
        .panel > .table-bordered > tbody > tr:last-child > th,
        .panel > .table-responsive > .table-bordered > tbody > tr:last-child > th,
        .panel > .table-bordered > tfoot > tr:last-child > th,
        .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > th {
            border-bottom: 0;
        }
        .panel > .table-responsive {
            margin-bottom: 0;
            border: 0;
        }
        .panel-group {
            margin-bottom: 20px;
        }
        .panel-group .panel {
            margin-bottom: 0;
        }
        .panel-group .panel + .panel {
            margin-top: 0px;
        }
        .panel-group .panel-heading {
            border-bottom: 0;
        }
        .panel-group .panel-heading + .panel-collapse > .panel-body,
        .panel-group .panel-heading + .panel-collapse > .list-group {

        }
        .panel-group .panel-footer {
            border-top: 0;
        }
        .panel-group .panel-footer + .panel-collapse .panel-body {
            border-bottom: 1px solid #ddd;
        }
        .panel-default {
            border-bottom: 1px solid #ddd;
        }
        .panel-default > .panel-heading {
            color: #333;
            background-color: #fff;

        }
        .panel-default > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #ddd;
        }
        .panel-default > .panel-heading .badge {
            color: #f5f5f5;
            background-color: #333;
        }
        .panel-default > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #ddd;
        }
        .panel-primary {
            border-color: #337ab7;
        }
        .panel-primary > .panel-heading {
            color: #fff;
            background-color: #337ab7;
            border-color: #337ab7;
        }
        .panel-primary > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #337ab7;
        }
        .panel-primary > .panel-heading .badge {
            color: #337ab7;
            background-color: #fff;
        }
        .panel-primary > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #337ab7;
        }
        .panel-success {
            border-color: #d6e9c6;
        }
        .panel-success > .panel-heading {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .panel-success > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #d6e9c6;
        }
        .panel-success > .panel-heading .badge {
            color: #dff0d8;
            background-color: #3c763d;
        }
        .panel-success > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #d6e9c6;
        }
        .panel-info {
            border-color: #bce8f1;
        }
        .panel-info > .panel-heading {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
        .panel-info > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #bce8f1;
        }
        .panel-info > .panel-heading .badge {
            color: #d9edf7;
            background-color: #31708f;
        }
        .panel-info > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #bce8f1;
        }
        .panel-warning {
            border-color: #faebcc;
        }
        .panel-warning > .panel-heading {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
        }
        .panel-warning > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #faebcc;
        }
        .panel-warning > .panel-heading .badge {
            color: #fcf8e3;
            background-color: #8a6d3b;
        }
        .panel-warning > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #faebcc;
        }
        .panel-danger {
            border-color: #ebccd1;
        }
        .panel-danger > .panel-heading {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .panel-danger > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #ebccd1;
        }
        .panel-danger > .panel-heading .badge {
            color: #f2dede;
            background-color: #a94442;
        }
        .panel-danger > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #ebccd1;
        }
        .embed-responsive {
            position: relative;
            display: block;
            height: 0;
            padding: 0;
            overflow: hidden;
        }
        .embed-responsive .embed-responsive-item,
        .embed-responsive iframe,
        .embed-responsive embed,
        .embed-responsive object,
        .embed-responsive video {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .embed-responsive-16by9 {
            padding-bottom: 56.25%;
        }
        .embed-responsive-4by3 {
            padding-bottom: 75%;
        }
        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        }
        .well blockquote {
            border-color: #ddd;
            border-color: rgba(0, 0, 0, .15);
        }
        .well-lg {
            padding: 24px;
            border-radius: 6px;
        }
        .well-sm {
            padding: 9px;
            border-radius: 3px;
        }
        .close {
            float: right;
            font-size: 21px;
            font-weight: bold;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            filter: alpha(opacity=20);
            opacity: .2;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            filter: alpha(opacity=50);
            opacity: .5;
        }
        button.close {
            -webkit-appearance: none;
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
        }
        .modal-open {
            overflow: hidden;
        }
        .modal {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            -webkit-overflow-scrolling: touch;
            outline: 0;
        }
        .modal.fade .modal-dialog {
            -webkit-transition: -webkit-transform .3s ease-out;
            -o-transition:      -o-transform .3s ease-out;
            transition:         transform .3s ease-out;
            -webkit-transform: translate(0, -25%);
            -ms-transform: translate(0, -25%);
            -o-transform: translate(0, -25%);
            transform: translate(0, -25%);
        }
        .modal.in .modal-dialog {
            -webkit-transform: translate(0, 0);
            -ms-transform: translate(0, 0);
            -o-transform: translate(0, 0);
            transform: translate(0, 0);
        }
        .modal-open .modal {
            overflow-x: hidden;
            overflow-y: auto;
        }
        .modal-dialog {
            position: relative;
            width: auto;
            margin: 10px;
        }
        .modal-content {
            position: relative;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #999;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 6px;
            outline: 0;
            -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
            box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        }
        .modal-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            background-color: #000;
        }
        .modal-backdrop.fade {
            filter: alpha(opacity=0);
            opacity: 0;
        }
        .modal-backdrop.in {
            filter: alpha(opacity=50);
            opacity: .5;
        }
        .modal-header {
            padding: 15px;
            border-bottom: 1px solid #e5e5e5;
        }
        .modal-header .close {
            margin-top: -2px;
        }
        .modal-title {
            margin: 0;
            line-height: 1.42857143;
            text-align: right;
            direction: rtl;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .modal-body {
            position: relative;
            padding: 0px 15px;
        }
        .modal-footer {
            padding: 15px;
            text-align: right;
            border-top: 1px solid #e5e5e5;
        }
        .modal-footer .btn + .btn {
            margin-bottom: 0;
            margin-left: 5px;
        }
        .modal-footer .btn-group .btn + .btn {
            margin-left: -1px;
        }
        .modal-footer .btn-block + .btn-block {
            margin-left: 0;
        }
        .modal-scrollbar-measure {
            position: absolute;
            top: -9999px;
            width: 50px;
            height: 50px;
            overflow: scroll;
        }
        @media (min-width: 768px) {
            .modal-dialog {
                width: 600px;
                margin: 100px auto;
            }
            .modal-content {
                -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
                box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
            }
            .modal-sm {
                width: 300px;
            }
        }
        @media (min-width: 992px) {
            .modal-lg {
                width: 900px;
            }
        }
        .tooltip {
            position: absolute;
            z-index: 1070;
            display: block;
            font-size: 12px;
            font-style: normal;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            word-wrap: normal;
            white-space: normal;
            filter: alpha(opacity=0);
            opacity: 0;

            line-break: auto;
        }
        .tooltip.in {
            filter: alpha(opacity=90);
            opacity: .9;
        }
        .tooltip.top {
            padding: 5px 0;
            margin-top: -3px;
        }
        .tooltip.right {
            padding: 0 5px;
            margin-left: 3px;
        }
        .tooltip.bottom {
            padding: 5px 0;
            margin-top: 3px;
        }
        .tooltip.left {
            padding: 0 5px;
            margin-left: -3px;
        }
        .tooltip-inner {
            max-width: 200px;
            padding: 3px 8px;
            color: #fff;
            text-align: center;
            background-color: #727272;
            border-radius: 4px;
        }
        .tooltip-arrow {
            position: absolute;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
        }
        .tooltip.top .tooltip-arrow {
            bottom: 0;
            left: 50%;
            margin-left: -5px;
            border-width: 5px 5px 0;
            border-top-color: #727272;
        }
        .tooltip.top-left .tooltip-arrow {
            right: 5px;
            bottom: 0;
            margin-bottom: -5px;
            border-width: 5px 5px 0;
            border-top-color: #727272;
        }
        .tooltip.top-right .tooltip-arrow {
            bottom: 0;
            left: 5px;
            margin-bottom: -5px;
            border-width: 5px 5px 0;
            border-top-color: #000;
        }
        .tooltip.right .tooltip-arrow {
            top: 50%;
            left: 0;
            margin-top: -5px;
            border-width: 5px 5px 5px 0;
            border-right-color: #000;
        }
        .tooltip.left .tooltip-arrow {
            top: 50%;
            right: 0;
            margin-top: -5px;
            border-width: 5px 0 5px 5px;
            border-left-color: #727272;
        }
        .tooltip.bottom .tooltip-arrow {
            top: 0;
            left: 50%;
            margin-left: -5px;
            border-width: 0 5px 5px;
            border-bottom-color: #000;
        }
        .tooltip.bottom-left .tooltip-arrow {
            top: 0;
            right: 5px;
            margin-top: -5px;
            border-width: 0 5px 5px;
            border-bottom-color: #000;
        }
        .tooltip.bottom-right .tooltip-arrow {
            top: 0;
            left: 5px;
            margin-top: -5px;
            border-width: 0 5px 5px;
            border-bottom-color: #000;
        }
        .popover {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1060;
            display: none;
            max-width: 276px;
            padding: 1px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            word-wrap: normal;
            white-space: normal;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 6px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);

            line-break: auto;
        }
        .popover.top {
            margin-top: -10px;
        }
        .popover.right {
            margin-left: 10px;
        }
        .popover.bottom {
            margin-top: 10px;
        }
        .popover.left {
            margin-left: -10px;
        }
        .popover-title {
            padding: 8px 14px;
            margin: 0;
            font-size: 14px;
            background-color: #f7f7f7;
            border-bottom: 1px solid #ebebeb;
            border-radius: 5px 5px 0 0;
        }
        .popover-content {
            padding: 9px 14px;
        }
        .popover > .arrow,
        .popover > .arrow:after {
            position: absolute;
            display: block;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
        }
        .popover > .arrow {
            border-width: 11px;
        }
        .popover > .arrow:after {
            content: "";
            border-width: 10px;
        }
        .popover.top > .arrow {
            bottom: -11px;
            left: 50%;
            margin-left: -11px;
            border-top-color: #999;
            border-top-color: rgba(0, 0, 0, .25);
            border-bottom-width: 0;
        }
        .popover.top > .arrow:after {
            bottom: 1px;
            margin-left: -10px;
            content: " ";
            border-top-color: #fff;
            border-bottom-width: 0;
        }
        .popover.right > .arrow {
            top: 50%;
            left: -11px;
            margin-top: -11px;
            border-right-color: #999;
            border-right-color: rgba(0, 0, 0, .25);
            border-left-width: 0;
        }
        .popover.right > .arrow:after {
            bottom: -10px;
            left: 1px;
            content: " ";
            border-right-color: #fff;
            border-left-width: 0;
        }
        .popover.bottom > .arrow {
            top: -11px;
            left: 50%;
            margin-left: -11px;
            border-top-width: 0;
            border-bottom-color: #999;
            border-bottom-color: rgba(0, 0, 0, .25);
        }
        .popover.bottom > .arrow:after {
            top: 1px;
            margin-left: -10px;
            content: " ";
            border-top-width: 0;
            border-bottom-color: #fff;
        }
        .popover.left > .arrow {
            top: 50%;
            right: -11px;
            margin-top: -11px;
            border-right-width: 0;
            border-left-color: #999;
            border-left-color: rgba(0, 0, 0, .25);
        }
        .popover.left > .arrow:after {
            right: 1px;
            bottom: -10px;
            content: " ";
            border-right-width: 0;
            border-left-color: #fff;
        }
        .carousel {
            position: relative;
        }
        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        .carousel-inner > .item {
            position: relative;
            display: none;
            -webkit-transition: .6s ease-in-out left;
            -o-transition: .6s ease-in-out left;
            transition: .6s ease-in-out left;
        }
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            line-height: 1;
        }
        @media all and (transform-3d), (-webkit-transform-3d) {
            .carousel-inner > .item {
                -webkit-transition: -webkit-transform .6s ease-in-out;
                -o-transition:      -o-transform .6s ease-in-out;
                transition:         transform .6s ease-in-out;

                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                -webkit-perspective: 1000px;
                perspective: 1000px;
            }
            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(100%, 0, 0);
                transform: translate3d(100%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-100%, 0, 0);
                transform: translate3d(-100%, 0, 0);
            }
            .carousel-inner > .item.next.left,
            .carousel-inner > .item.prev.right,
            .carousel-inner > .item.active {
                left: 0;
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
        }
        .carousel-inner > .active,
        .carousel-inner > .next,
        .carousel-inner > .prev {
            display: block;
        }
        .carousel-inner > .active {
            left: 0;
        }
        .carousel-inner > .next,
        .carousel-inner > .prev {
            position: absolute;
            top: 0;
            width: 100%;
        }
        .carousel-inner > .next {
            left: 100%;
        }
        .carousel-inner > .prev {
            left: -100%;
        }
        .carousel-inner > .next.left,
        .carousel-inner > .prev.right {
            left: 0;
        }
        .carousel-inner > .active.left {
            left: -100%;
        }
        .carousel-inner > .active.right {
            left: 100%;
        }
        .carousel-control {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 15%;
            font-size: 20px;
            color: #fff;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
            background-color: rgba(0, 0, 0, 0);
            filter: alpha(opacity=50);
            opacity: .5;
        }
        .carousel-control.left {
            background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, .5) 0%, rgba(0, 0, 0, .0001) 100%);
            background-image:      -o-linear-gradient(left, rgba(0, 0, 0, .5) 0%, rgba(0, 0, 0, .0001) 100%);
            background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, .5)), to(rgba(0, 0, 0, .0001)));
            background-image:         linear-gradient(to right, rgba(0, 0, 0, .5) 0%, rgba(0, 0, 0, .0001) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
            background-repeat: repeat-x;
        }
        .carousel-control.right {
            right: 0;
            left: auto;
            background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, .0001) 0%, rgba(0, 0, 0, .5) 100%);
            background-image:      -o-linear-gradient(left, rgba(0, 0, 0, .0001) 0%, rgba(0, 0, 0, .5) 100%);
            background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, .0001)), to(rgba(0, 0, 0, .5)));
            background-image:         linear-gradient(to right, rgba(0, 0, 0, .0001) 0%, rgba(0, 0, 0, .5) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
            background-repeat: repeat-x;
        }
        .carousel-control:hover,
        .carousel-control:focus {
            color: #fff;
            text-decoration: none;
            filter: alpha(opacity=90);
            outline: 0;
            opacity: .9;
        }
        .carousel-control .icon-prev,
        .carousel-control .icon-next,
        .carousel-control .glyphicon-chevron-left,
        .carousel-control .glyphicon-chevron-right {
            position: absolute;
            top: 50%;
            z-index: 5;
            display: inline-block;
            margin-top: -10px;
        }
        .carousel-control .icon-prev,
        .carousel-control .glyphicon-chevron-left {
            left: 50%;
            margin-left: -10px;
        }
        .carousel-control .icon-next,
        .carousel-control .glyphicon-chevron-right {
            right: 50%;
            margin-right: -10px;
        }
        .carousel-control .icon-prev,
        .carousel-control .icon-next {
            width: 20px;
            height: 20px;
            font-family: serif;
            line-height: 1;
        }
        .carousel-control .icon-prev:before {
            content: '\2039';
        }
        .carousel-control .icon-next:before {
            content: '\203a';
        }
        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            z-index: 15;
            width: 60%;
            padding-left: 0;
            margin-left: -30%;
            text-align: center;
            list-style: none;
        }
        .carousel-indicators li {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin: 1px;
            text-indent: -999px;
            cursor: pointer;
            background-color: #000 \9;
            background-color: rgba(0, 0, 0, 0);
            border: 1px solid #fff;
            border-radius: 10px;
        }
        .carousel-indicators .active {
            width: 12px;
            height: 12px;
            margin: 0;
            background-color: #fff;
        }
        .carousel-caption {
            position: absolute;
            right: 15%;
            bottom: 20px;
            left: 15%;
            z-index: 10;
            padding-top: 20px;
            padding-bottom: 20px;
            color: #fff;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
        }
        .carousel-caption .btn {
            text-shadow: none;
        }
        @media screen and (min-width: 768px) {
            .carousel-control .glyphicon-chevron-left,
            .carousel-control .glyphicon-chevron-right,
            .carousel-control .icon-prev,
            .carousel-control .icon-next {
                width: 30px;
                height: 30px;
                margin-top: -10px;
                font-size: 30px;
            }
            .carousel-control .glyphicon-chevron-left,
            .carousel-control .icon-prev {
                margin-left: -10px;
            }
            .carousel-control .glyphicon-chevron-right,
            .carousel-control .icon-next {
                margin-right: -10px;
            }
            .carousel-caption {
                right: 20%;
                left: 20%;
                padding-bottom: 30px;
            }
            .carousel-indicators {
                bottom:30px;
            }
        }
        .clearfix:before,
        .clearfix:after,
        .dl-horizontal dd:before,
        .dl-horizontal dd:after,
        .container:before,
        .container:after,
        .container-fluid:before,
        .container-fluid:after,
        .row:before,
        .row:after,
        .form-horizontal .form-group:before,
        .form-horizontal .form-group:after,
        .btn-toolbar:before,
        .btn-toolbar:after,
        .btn-group-vertical > .btn-group:before,
        .btn-group-vertical > .btn-group:after,
        .nav:before,
        .nav:after,
        .navbar:before,
        .navbar:after,
        .navbar-header:before,
        .navbar-header:after,
        .navbar-collapse:before,
        .navbar-collapse:after,
        .pager:before,
        .pager:after,
        .panel-body:before,
        .panel-body:after,
        .modal-header:before,
        .modal-header:after,
        .modal-footer:before,
        .modal-footer:after {
            display: table;
            content: " ";
        }
        .clearfix:after,
        .dl-horizontal dd:after,
        .container:after,
        .container-fluid:after,
        .row:after,
        .form-horizontal .form-group:after,
        .btn-toolbar:after,
        .btn-group-vertical > .btn-group:after,
        .nav:after,
        .navbar:after,
        .navbar-header:after,
        .navbar-collapse:after,
        .pager:after,
        .panel-body:after,
        .modal-header:after,
        .modal-footer:after {
            clear: both;
        }
        .center-block {
            display: block;
            margin-right: auto;
            margin-left: auto;
        }
        .pull-right {
            float: right !important;
        }
        .pull-left {
            float: left !important;
        }
        .hide {
            display: none !important;
        }
        .show {
            display: block !important;
        }
        .invisible {
            visibility: hidden;
        }
        .text-hide {
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }
        .hidden {
            display: none !important;
        }
        .affix {
            position: fixed;
        }
        @-ms-viewport {
            width: device-width;
        }
        .visible-xs,
        .visible-sm,
        .visible-md,
        .visible-lg {
            display: none !important;
        }
        .visible-xs-block,
        .visible-xs-inline,
        .visible-xs-inline-block,
        .visible-sm-block,
        .visible-sm-inline,
        .visible-sm-inline-block,
        .visible-md-block,
        .visible-md-inline,
        .visible-md-inline-block,
        .visible-lg-block,
        .visible-lg-inline,
        .visible-lg-inline-block {
            display: none !important;
        }
        @media (max-width: 767px) {
            .visible-xs {
                display: block !important;
            }
            table.visible-xs {
                display: table !important;
            }
            tr.visible-xs {
                display: table-row !important;
            }
            th.visible-xs,
            td.visible-xs {
                display: table-cell !important;
            }
        }
        @media (max-width: 767px) {
            .visible-xs-block {
                display: block !important;
            }
        }
        @media (max-width: 767px) {
            .visible-xs-inline {
                display: inline !important;
            }
        }
        @media (max-width: 767px) {
            .visible-xs-inline-block {
                display: inline-block !important;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .visible-sm {
                display: block !important;
            }
            table.visible-sm {
                display: table !important;
            }
            tr.visible-sm {
                display: table-row !important;
            }
            th.visible-sm,
            td.visible-sm {
                display: table-cell !important;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .visible-sm-block {
                display: block !important;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .visible-sm-inline {
                display: inline !important;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .visible-sm-inline-block {
                display: inline-block !important;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .visible-md {
                display: block !important;
            }
            table.visible-md {
                display: table !important;
            }
            tr.visible-md {
                display: table-row !important;
            }
            th.visible-md,
            td.visible-md {
                display: table-cell !important;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .visible-md-block {
                display: block !important;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .visible-md-inline {
                display: inline !important;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .visible-md-inline-block {
                display: inline-block !important;
            }
        }
        @media (min-width: 1200px) {
            .visible-lg {
                display: block !important;
            }
            table.visible-lg {
                display: table !important;
            }
            tr.visible-lg {
                display: table-row !important;
            }
            th.visible-lg,
            td.visible-lg {
                display: table-cell !important;
            }
        }
        @media (min-width: 1200px) {
            .visible-lg-block {
                display: block !important;
            }
        }
        @media (min-width: 1200px) {
            .visible-lg-inline {
                display: inline !important;
            }
        }
        @media (min-width: 1200px) {
            .visible-lg-inline-block {
                display: inline-block !important;
            }
        }
        @media (max-width: 767px) {
            .hidden-xs {
                display: none !important;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .hidden-sm {
                display: none !important;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .hidden-md {
                display: none !important;
            }
        }
        @media (min-width: 1200px) {
            .hidden-lg {
                display: none !important;
            }
        }
        .visible-print {
            display: none !important;
        }
        @media print {
            .visible-print {
                display: block !important;
            }
            table.visible-print {
                display: table !important;
            }
            tr.visible-print {
                display: table-row !important;
            }
            th.visible-print,
            td.visible-print {
                display: table-cell !important;
            }
        }
        .visible-print-block {
            display: none !important;
        }
        @media print {
            .visible-print-block {
                display: block !important;
            }
        }
        .visible-print-inline {
            display: none !important;
        }
        @media print {
            .visible-print-inline {
                display: inline !important;
            }
        }
        .visible-print-inline-block {
            display: none !important;
        }
        @media print {
            .visible-print-inline-block {
                display: inline-block !important;
            }
        }
        @media print {
            .hidden-print {
                display: none !important;
            }
        }


        html, body {
            overflow:auto;
            margin:0;
            padding:0;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }
    </style>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="clearfix container inner-content" >
    <div class="relative-wrapper visible-lg visible-md visible-sm hidden-xs">
        @if($CV->user->cover=="")
            <div class="top-innerpage" style="background:url('/site/default/img/cover.jpg') no-repeat top center/cover;"></div>
        @else
            <div class="top-innerpage" style="background:url('{{$CV->user->cover}}') no-repeat top center/cover;"></div>
        @endif
        <div class="bgdark " style="background:url('/site/default/img/bgdark.png') no-repeat top center/cover;">
            <img src="{{$CV->user->avatar}}" alt="" class="fr-img-curve">
            <h2>{{$CV->user->first_name.' '.$CV->user->last_name}}
            </h2>
            <h3>{{$CV->province->name}}</h3>
            <img src="/site/default/img/print-logo.png" alt="" class="fl-img-logo">
        </div>
    </div>
    <div class="bgdark1 xs-header hidden-lg hidden-md hidden-sm visible-xs" align="center">
        <div class="top-innerpage hidden-sm hidden-xs" ></div>
        <img src="{{$CV->user->avatar}}" alt="" class="img-curve">
        <h2>{{$CV->user->first_name.' '.$CV->user->last_name}} </h2>
        <h3>{{$CV->province->name}}</h3>
        <img src="/site/default/img/print-logo.png" alt="" class="p-img-logo hidden-sm hidden-xs">
    </div>
    <div class="col-xs-12 left-jobs no-padd-xs no-padd">

            <div class="col-md-6">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">مشخصات عمومی</div>
                    <p><strong>نام و نام خانوادگی : </strong> {{$CV->user->first_name.' '.$CV->user->last_name}}</p>
                    <p><strong>کد ملی : </strong>{{$CV->user->profile->national_code}}</p>
                    <p><strong>جنسیت : </strong>
                    @if($CV->user->profile->gender==1)
                        مرد
                    @endif
                    @if($CV->user->profile->gender==2)
                            زن
                    @endif
                    @if($CV->user->profile->gender==3)
                            همه
                    @endif
                    </p>
                    <p><strong>تاریخ تولد : </strong>{{str_replace('-','/',$CV->user->profile->born_date)}}</p>
                    <p><strong>وضعیت تاهل : </strong>
                    @if($CV->user->profile->marital_status==1)
                        مجرد
                    @endif
                    @if($CV->user->profile->marital_status==2)
متاهل
                    @endif
                    @if($CV->user->profile->marital_status==3)
متارکه
                    @endif
                    </p>
                    @if($CV->user->profile->marital_status==2)
                    <p><strong>تاریخ ازدواج : </strong>{{str_replace('-','/',$CV->user->profile->marriage_date)}}</p>
                    @endif

                    @if(isset($CV->user->profile->military_status) && !is_null($CV->user->profile->military_status))                    <p><strong>وضعیت نظام وظیفه : </strong>
                        @if($CV->user->profile->military_status==1)
                            پایان خدمت
                        @endif
                        @if($CV->user->profile->military_status==2)
                            معافیت
                        @endif
                        @if($CV->user->profile->military_status==3)
                            خرید خدمت
                        @endif
                        @if($CV->user->profile->military_status==4)
                            مشمول
                        @endif
                    @endif

                    @if($CV->user->profile->military_status==1)
                    <p><strong>تاریخ پایان خدمت : </strong> {{(!empty($CV->user->profile->military_end_date)?str_replace('-','/',$CV->user->profile->military_end_date):'وارد نشده')}}</p>
                    @endif
                    @if($CV->user->profile->military_status==2)
                    <p><strong>دلیل معافیت : </strong>{{--(!empty($CV->user->profile->reason_exemption)?$CV->user->profile->reason_exemption:'وارد نشده')--}}
                        @if(!empty($CV->user->profile->reason_exemption))
                            @if($CV->user->profile->reason_exemption==1)
                                تحصیلی
                            @endif
                            @if($CV->user->profile->reason_exemption==2)
کفالت
                            @endif
                            @if($CV->user->profile->reason_exemption==3)
پزشکی
                            @endif
                            @if($CV->user->profile->reason_exemption==4)
موارد خاص
                            @endif

                        @endif
                    </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">محل سکونت</div>
                    <p><strong>استان : </strong> {{$CV->user->profile->province->name}} </p>
                    <p><strong>شهر/شهرستان : </strong> {{$CV->user->profile->city->name}}</p>
                    @if(!is_null($CV->user->profile->neighborhood))
                    <p><strong>محله : </strong> {{$CV->user->profile->neighborhood}}</p>
                    @endif
                    <p><strong>تلفن منزل : </strong> {{$CV->user->profile->home_phone}}</p>
                    <p><strong>تلفن همراه : </strong> {{$CV->user->mobile}} </p>
                    <p><strong>ایمیل : </strong>{{(!empty($CV->user->email)?$CV->user->email:'وارد نشده')}} </p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">مشخصات شغل درخواستی</div>
                    <p class=""><strong>استان : </strong> {{$CV->province->name}}</p>
                    <p><strong>نوع همکاری : </strong> {{implode('، ',$CV->contractTypes->pluck('name')->toArray())}}</p>
                    @if(isset($CV->experimental_expertises) && $CV->experimental_expertises->count())
                    <p><strong>زمینه تخصصی : </strong>{{implode('، ',$CV->experimental_expertises->pluck('name')->toArray())}} </p>
                    @endif
                    <p><strong> زمینه صنعت :</strong> {{implode('، ',$CV->industries->pluck('name')->toArray())}} </p>
                    <p><strong> طریقه آشنایی با شرکت : </strong>

                        @if($CV->referer==1)
آگهی روزنامه
                        @endif
                        @if($CV->referer==2)
                            تماس اولیه از طرف گلرنگ
                        @endif
                        @if($CV->referer==3)
                            سایت شرکت
                        ({{$CV->site->first()->url}})
                        @endif
                        {{--
                        @if($CV->referer==4)
                            آژانس کاریابی
                        @endif--}}
                        @if($CV->referer==4)
                            معرفي آشنايان و دوستان
                        @endif
                        @if($CV->referer==5)
                            مراکز کاريابي
                        @endif
                        @if($CV->referer==8)
                            نمایشگاه کار
                        @endif
                        @if($CV->referer==6)
                            معرفی کارکنان گلرنگ
                        @endif
                        @if($CV->referer==7)
                            سایر
                        ({{$CV->other}})
                        @endif
                    </p>
                    @if($CV->introducer)


                            <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">
                                <p><i class="fa fa-angle-left"></i><strong> نام و نام خانوادگی : </strong> {{$CV->introducer->name}} </p>
                                <p><i class="fa fa-angle-left"></i><strong> نام شرکت :  </strong> {{$CV->introducer->company_name}} </p>
                                <p><i class="fa fa-angle-left"></i><strong> نسبت : </strong> {{$CV->introducer->relevance}} </p>
                                <p><i class="fa fa-angle-left"></i><strong> سمت : </strong> {{$CV->introducer->post}}</p>
                            </div>

                    @endif
                </div>
            </div>


            <div class="col-md-12">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">تحصیلات</div>



                    @foreach($CV->educational_details as $grade)
                        @php
                        $c++;
                        @endphp
                    <p class=""><strong>{{$c}}</strong> :
                    از تاریخ {{str_replace('-','/',$grade->start_date)}}
                    تا
                    @if($grade->end_date!="")
                        {{str_replace('-','/',$grade->end_date)}} </p>
                    @else
                        اکنون
                    @endif

                    <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">
                        <p><strong>مقطع تحصیلی  : </strong> {{config('app.enum_last_degree')[$grade->grade]}}</p>
                        <p><strong>رشته :  </strong>  {{$grade->field}}  </p>
                        <p><strong> گرایش : </strong> {{$grade->tendency}} </p>
                        <p><strong> موسسه : </strong> {{$grade->institute}}  </p>
                        <p><strong> معدل : </strong> {{$grade->average}}  </p>
                    </div>

                    @endforeach
                </div>
            </div>


        {{--@if(isset($CV->professional_training_records) && ($CV->professional_training_records->count()))--}}
        <div class="col-md-12">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title"> آموزش ها و سوابق</div>
                    @if(isset($CV->professional_training_records) && $CV->professional_training_records->count())


                    <p class=""><strong>   آموزشی تخصصی </strong></p>



                    @foreach($CV->professional_training_records as $expert)




                    <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">
                        <p><strong> عنوان دوره  : </strong> {{$expert->name}}  </p>
                        <p><strong> امکان ارائه گواهینامه  : </strong> {{($expert->pivot->has_certificate)?'بله':'خیر'}}</p>
                        <p><strong>مدت دوره :  </strong>  {{$expert->pivot->duration}} ساعت  </p>
                        <p><strong> نام آموزشگاه/موسسه : </strong> {{$expert->pivot->institute_name}} </p>

                    </div>

                    @endforeach

                    @endif

                  @if(isset($CV->work_experiences) && $CV->work_experiences->count())
                       {{-- <p><strong> مهارتها یا تخصصهای تجربی</strong> </p>--}}

                        <div class="col-md-12 no-padd no-padd-xs"><h2 class="clearfix exph">سوابق کاری  </h2></div>

                    @foreach($CV->work_experiences as $work)
                                <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">
                                    <p><strong> نام سازمان  : </strong> {{$work->title}}  </p>
                                    <p><strong>  تاریخ شروع  :  </strong> {{str_replace('-','/',$work->start_date)}}   </p>
                                    <p><strong> تاریخ پایان : </strong> {{str_replace('-','/',$work->end_date)}} </p>
                                    <p><strong> آخرین سمت سازمانی : </strong> {{$work->last_post}} </p>
                                </div>




                                <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">
                        <p><strong>  علت قطع همکاری  :  </strong>  {{$work->cause_interruption}}  </p>
                        <p><strong> شماره تماس : </strong> {{$work->phone_number}} </p>
                        <p><strong> اهم وظایف : </strong> {{$work->important_tasks}} </p>
                    </div>

                    @endforeach

                  @endif


                   @if(isset($CV->experimental_expertises) && ($CV->experimental_expertises->count()))
                        <div class="col-md-12 no-padd no-padd-xs"><h2 class="clearfix exph"> مهارت های تجربی  </h2></div>

                    @php
                    $ar=[
                    1=>'عالی',
                    2=>'خوب',
                    3=>'متوسط',
                    4=>'ضعیف'
                    ]
                    @endphp
                    @foreach($CV->experimental_expertises as $exp)

                    <p><strong> عنوان   : </strong> {{$exp->name}}  </p>
                    <p><strong>  میزان تسلط   :  </strong> {{$ar[$exp->pivot->proficiency]}}   </p>
                    <p><strong>  توضیحات : </strong>{{$exp->pivot->description}} </p>

                    @endforeach

                        @endif
                </div>

            </div>

        {{--@endif--}}



        <div class="col-md-6">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title"> آشنایی با زبان های خارجی</div>

                    @foreach($CV->foreign_languages as $lang)

                    <p><strong> عنوان : </strong> {{$lang->title}} </p>
                    <p><strong> مکالمه : </strong>
                    @if($lang->conversation==1)
                        عالی
                    @endif
                        @if($lang->conversation==2)
                            خوب
                        @endif
                        @if($lang->conversation==3)
                            متوسط
                        @endif
                        @if($lang->conversation==4)
                            ضعیف
                        @endif
                    </p>
                    <p><strong> نگارش : </strong>
                        @if($lang->writing==1)
                            عالی
                        @endif
                        @if($lang->writing==2)
                            خوب
                        @endif
                        @if($lang->writing==3)
                            متوسط
                        @endif
                        @if($lang->writing==4)
                            ضعیف
                        @endif
                    </p>
                    <p><strong> درک مطلب و ترجمه : </strong>
                        @if($lang->comprehension==1)
                            عالی
                        @endif
                        @if($lang->comprehension==2)
                            خوب
                        @endif
                        @if($lang->comprehension==3)
                            متوسط
                        @endif
                        @if($lang->comprehension==4)
                            ضعیف
                        @endif
                    </p>
                    @if(!empty($lang->certificate))
                    <p><strong> گواهینامه : </strong>
                        {{$lang->certificate}}
                    </p>
                    @endif
                    <hr/>
                    <!--                                    <div class="hr-pdf"></div>-->
                    @endforeach
                </div>
            </div>
        @if(isset($CV->computer_skills) && ($CV->computer_skills->count()))
            <div class="col-md-6">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">  آشنایی با کامپیوتر</div>

                    @foreach($CV->computer_skills as $skill)

                    <p><strong>نام نرم افزار :  </strong> {{$skill->name}} </p>
                    <p><strong> میزان تسلط : </strong>
                        @if($skill->pivot->proficiency==1)
                            عالی
                        @endif
                        @if($skill->pivot->proficiency==2)
                            خوب
                        @endif
                        @if($skill->pivot->proficiency==3)
                            متوسط
                        @endif
                        @if($skill->pivot->proficiency==4)
                            ضعیف
                        @endif
                    </p>
                    <p><strong> گواهینامه : </strong> {{($skill->pivot->has_certificate==1?'بله':'خیر')}} </p>
                    <p><strong> توضیحات : </strong>{{$skill->pivot->description}}</p>
                        <hr/>

                    @endforeach

                </div>
            </div>
        @endif


        @if($CV->family)
        <div class="col-md-12">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">اطلاعات تکمیلی</div>
                    <p><strong>مشخصات اعضای خانواده</strong></p>

                    @php
                    $ar=[
                    1=>'پدر',
                    2=>'مادر',
                    3=>'خواهر',
                    4=>'برادر',
                    5=>'همسر',
                    6=>'فرزند'

                    ]
                    @endphp
                    @foreach($CV->family as $family)

                    <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">
                        <p><i class="fa fa-angle-left"></i><strong> نام و نام خانوادگی : </strong> {{$family->name}} </p>
                        <p><i class="fa fa-angle-left"></i><strong> نسبت  :  </strong> {{$ar[$family->relation]}} </p>
                        <p><i class="fa fa-angle-left"></i><strong> شغل/عدم اشتغال : </strong>
                            {{(is_null($family->job)?'عدم اشتغال':$family->job)}} </p>
                        <p><i class="fa fa-angle-left"></i><strong> سازمان/صنف : </strong>  {{$family->organization}} </p>
                    </div>

                    @endforeach

                </div>
            </div>
        @endif

        @if(isset($CV->questions) && ($CV->questions->count()))

            <div class="col-md-12">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">سوالات تکمیلی</div>
                    <p><strong>لطفا خالص حقوق و مزایای ماهیانه درخواستی خود را در کادر مقابل (به ریال) درج فرمایید : </strong> {{number_format($CV->questions->requested_salary)}}  ریال</p>
                    <p><strong>آیا سابقه محکومیت کیفری داشته اید؟ </strong>{{($CV->questions->crime==1?'بله':'خیر')}}</p>
                    @if($CV->questions->crime==1)
                    <p><strong>علت؟</strong><br/>
                        {{$CV->questions->crime_description}}
                    </p>
                    @endif

                    <p><strong>آيا سابقه بيماري یا جراحی خاصی داشته ايد؟   </strong> {{($CV->questions->treatment==1?'بله':'خیر')}}</p>
                    @if($CV->questions->treatment==1)
                    <p><strong>نام بیماری/جراحی -  آیا کاملا بهبود یافته اید؟</strong>  {{($CV->questions->sickness==1?'بله':'خیر')}}
                        <br>
                        {{$CV->questions->sickness_description}}
                    </p>
                    @endif

                    <p><strong>مهم ترین موفقیت کاری/شخصی شما چه بوده است؟ لطفا توضیح دهید.</strong><br/>
                        {{$CV->questions->Q1}}
                    </p>
                    <p><strong>اهداف کاري/ شخصی خود را براي 5 سال آینده بیان نمائید.</strong><br/>
                        {{$CV->questions->Q2}}
                    </p>
                    <p><strong>بارزترین ارزش، توانایی یا قابلیتی که براي شرکت به همراه میآورید چیست؟</strong><br/>
                        {{$CV->questions->Q3}}
                         </p>
                    <p><strong>درصورتی که نکته خاصی وجود دارد که احتمالا در استخدام/عدم استخدام شما موثر است، بیان نمائید.</strong><br/>
                        {{$CV->questions->Q4}}
                    </p>
                    <p><strong>آیا از کارکنان گروه صنعتی گلرنگ کسی را میشناسید؟</strong><br/>
                    {{(count($CV->introducers->toArray())?'بله':'خیر')}}
                    </p>

                    @foreach($CV->introducers as $person)

                    <div class="clearfix col-md-12 wrap-pdf-inner no-padd-xs no-padd">

                        <p><i class="fa fa-angle-left"></i><strong> نام و نام خانوادگی : </strong> {{$person->name}} </p>
                        <p><i class="fa fa-angle-left"></i><strong> نام شرکت فعلی :  </strong> {{$person->compnay_name}} </p>
                        <p><i class="fa fa-angle-left"></i><strong> نسبت : </strong> {{$person->relevance}} </p>
                        <p><i class="fa fa-angle-left"></i><strong> سمت : </strong> {{$person->post}}</p>

                    </div>

                    @endforeach

                </div>
            </div>
       
        @endif
    </div>

    <a href="javascript:void(0);" onclick="window.print();">چاپ</a>

    <br>
    <button id="btnSave">Image</button>
    <div id="img-out"></div>

</div>
</div>

<script src="/site/default/js/vendor/jquery-1.12.0.min.js"></script>
<script src="/site/default/js/bootstrap.min.js"></script>
<script src="/site/default/js/persianumber.min.js"></script>
<script src="/site/default/js/classie.js"></script>
<script src="/site/default/js/plugins.js"></script>
<script src="/site/default/js/reveal-animate.js"></script>
<script src="/site/default/js/wow.min.js"></script>
<script src="/site/default/js/owl.carousel.min.js"></script>
<script src="/site/default/js/cubeportfolio.min.js"></script>
<script src="/site/default/js/jquery.easing.min.js"></script>
<script src="/site/default/js/main.js"></script>

<scritp src="https://html2canvas.hertzen.com/build/html2canvas.js"></scritp>

<script>

    html2canvas(document.body, {
      onrendered: function(canvas) {
        document.body.appendChild(canvas);
      }
    });


</script>
</body>
</html>
