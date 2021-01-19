<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SMS extends Model
{
//    protected $gateway = 'http://rest.payamak-panel.com/api/SendSMS/SendSMS';
    protected $user_name = 'Marketinggig';
    protected $password = '8436';
    protected $From = '20009566';
//    public function Send($text,$to,$is_flash,$ref,$user_id)
//    {
//        if(User::find($user_id)->smses()->whereDate('created_at', \DB::raw('CURDATE()'))->count() >= 18)
//        {
//            return redirect()->back()
//                ->with('flash_message', 'تعداد SMS های ارسالی برای شما در امروز به حد نصاب خود رسیده است، لطفا روز بعد مجددا جهت دریافت، تلاش فرمایید.');
//        }
//        $client = new \GuzzleHttp\Client();
//        $response = $client->post($this->gateway, [
//            'form_params' => [
//                'UserName' => $this->user_name,
//                'PassWord' => $this->password,
//                'To' => $to,
//                'From' => $this->From,
//                'Text' => $text,
//                'IsFlash' => $is_flash,
//            ]]);
//        $sms = new SMS();
//        $sms->user_id = $user_id;
//        $sms->message = $text;
//        $sms->ref = $ref;
//        $sms->sent = 1;
//        $sms->save();
//    }
    protected $gateway = 'https://icrm-services.golrang.com:8000/SMS/SendSMS';
    public function Send($text,$to,$is_flash,$ref,$user_id)
    {
        if(User::find($user_id)->smses()->whereDate('created_at', \DB::raw('CURDATE()'))->count() >= 3)
        {
            return redirect()->back()
                ->with('flash_message', 'تعداد SMS های ارسالی برای شما در امروز به حد نصاب خود رسیده است، لطفا روز بعد مجددا جهت دریافت، تلاش فرمایید.');
        }
        $err_sms_count= User::find(1)->smses()->where('ref','err')->whereDate('created_at', \DB::raw('CURDATE()'))->count();
        if($err_sms_count>1)
            return 0;

        $curl = curl_init();
        $text = urlencode($text);
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8000",
            CURLOPT_URL => "https://icrm-services.golrang.com:8000/SMS/SendSMS",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
//zoee
           CURLOPT_SSL_VERIFYHOST=> false,
           CURLOPT_SSL_VERIFYPEER=> false,
//zoee

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "Description=$text&PhoneNumber=$to&Token=hr52154%7B&SubSystem=31&Version=0&DeviceType=0&ByAdmin=0",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
            ),
        ));
        for($i = 0; $i < 10; $i++) {
            $response = curl_exec($curl);
            $response = json_decode($response,1);

            if($response['Success'] == true)
                break;
        }
        $sms = new SMS();
        $sms->user_id = $user_id;
        $sms->message = $text;
        $sms->ref = $ref;
        if($response['Success'] == true)
            $sms->sent = 1;
        else
            $sms->sent = 0;
        $sms->save();

    }
    
    public function user()
    {
        return $this->belongsTo('HR\User');
    }
}
