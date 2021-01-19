<!doctype html>
<html class="no-js" lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>سامانه منابع انسانی گلرنگ | رزومه</title>
    <meta name="description" content="سامانه منابع انسانی گلرنگ | رزومه">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://people.golrang.com/resume/css/main.css">
    <?php
    include('jdf.php');
    ?>
</head>
<body>

<section id="footer-logo" class="container" style="background:none ;width: 292px;float:right; background-color: #fff">
    <img style="height: 130px; margin-right: 60px" src="https://people.golrang.com/resume/img/gig-logo.png">
</section>
<section  style="float: left;height: 130px;margin-top: 65px">
    تاریخ چاپ:
    <span id="printYY"><?=jdate('Y');?></span>/<span id="printDD"><?=jdate('m');?></span>/<span id="printMM"><?=jdate('d');?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    صفحه <span id='page'>۱</span> از <span id='topage'>1</span>
    <script>
        let vars={};
        let x=document.location.search.substring(1).split('&');
        for (let i in x) {let z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}
        let x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
        for (let i in x) {
            let y = document.getElementsByClassName(x[i]);
            for (let j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
            document.getElementById('page').innerHTML = vars['page'];
            // if(vars['topage']>1) {vars['topage']=1;}
            document.getElementById('topage').innerHTML = vars['topage'];
        }
    </script>
</section>
</body>
</html>


