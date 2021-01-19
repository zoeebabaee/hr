<!--@if($role == 'user')
@else
    <p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">
    همکار گرامی</span></span></span></span></p>
@endif-->
@if($ticket->status == 'closed')

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">کاربر گرامی</span></span></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">پاسخ تیکت شما به شماره {{$ticket->id}} به شرح ذیل می باشد.</span></span></span></span></span></p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">{{$reply->body}}</span></span></span></span></span></p>



@else
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">کاربر عزیز</span></span></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">تیکت شما با شماره ی {{$ticket->id}} دریافت شد و در حال بررسی است.</span></span></span></span></span></p>

<p dir="RTL" style="margin-left:0.5in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"></span><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;"> از صبر و شکیبایی شما سپاس‌گزاریم

 </span></span></span></span></span></p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right">&nbsp;</p>
@endif