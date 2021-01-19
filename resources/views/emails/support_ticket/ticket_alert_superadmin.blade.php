<!--@if($role == 'user')
@else
    <p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">
    همکار گرامی</span></span></span></span></p>
@endif-->
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif">
    <span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">با سلام و احترام</span></span></span></span></p>

<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif">
    <span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">درخواست پشتیبانی توسط کاربر {{$ticket->user->first_name.' '.$ticket->user->last_name}} با موضوع {{$ticket->persian_subject}} ثبت گردید </span></span></span></span></span></p>

<p dir="RTL" style="margin-left:0.5in; margin-right:0in; text-align:right"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,sans-serif">
    <span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;">&middot; </span></span>برای مشاهده جزییات بیشتر <a href="{{route('support.tickets.show', ['id' => $ticket])}}" style="color:#0563
    
    c1; text-decoration:underline"><span style="font-size:14.0pt"><span style="font-family:&quot;B Nazanin&quot;"> کلیک کنید </span></span></span></a></span></span></p>
<p dir="RTL" style="margin-left:0in; margin-right:0in; text-align:right">&nbsp;</p>
