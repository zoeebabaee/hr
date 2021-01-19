@if($job->approved == 1)
@if($admin->profile)
    <p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">
    همکار گرامی</span></span></span></span></p>
@endif
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">با سلام و احترام</span></span></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">آگهی &laquo;{{$job->title}}&raquo;  شرکت «{{$job->company->name}}» در سامانه منابع انسانی منتشر شد، لطفا با کلیک روی لینک زیر، رزومه های دریافتی را مدیریت نمایید و پس از  بررسی هریک از رزومه ها گزینه  "برگزیده" یا "نامتناسب" را جهت اطلاع کارجویان از وضعیت درخواست همکاری، ثبت فرمایید.</span></span></span></span></p>
<p dir="RTL" style="margin-left:0.5in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:Symbol">&middot; </span></span><a href="{{route('applies.index', ['id' => $job->id])}}" style="color:#0563c1; text-decoration:underline"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;"> مدیریت مشاغل فعال در سامانه</span></span></a></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right">&nbsp;</p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">با تشکر</span></span></span></span></p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">سامانه منابع انسانی گروه صنعتی گلرنگ</span></span></span></span></p>

@else
@if($admin->profile)
    <p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">
    همکار گرامی</span></span></span></span></p>
@endif
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">با سلام و احترام</span></span></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">آگهی &laquo;{{$job->title}}&raquo;  شرکت «{{$job->company->name}}» در سامانه منابع انسانی نیاز به ویرایش دارد، لطفا با کلیک روی لینک زیر، موارد اعلام شده توسط مدیر سایت را بررسی و اصلاح نمایید.</span></span></span></span></p>
<p dir="RTL" style="margin-left:0.5in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:Symbol">&middot; </span></span><a href="{{route('jobs.edit', ['id' => $job->id])}}" style="color:#0563c1; text-decoration:underline"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;"> مدیریت مشاغل فعال در سامانه</span></span></a></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right">&nbsp;</p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">با تشکر</span></span></span></span></p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">سامانه منابع انسانی گروه صنعتی گلرنگ</span></span></span></span></p>
@endif
