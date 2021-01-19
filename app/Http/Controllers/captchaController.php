<?php

namespace HR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class captchaController extends Controller
{
    public function index($ref)
    {
        // Set the content-type

        // Create the image
        $im = imagecreatetruecolor(190, 35);
        // Create some colors
        $white = imagecolorallocate($im, 236, 236, 236);
        $grey = imagecolorallocate($im, 125, 125, 125);
        $black = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 399, 40, $white);

        // The text to draw
        $characters = '1234578ABCDEFHKMNPQRSTUWXYZ';
        $charactersLength = strlen($characters);
        $text = '';
        $length = 5;
        for ($i = 0; $i < $length; $i++) {
            $text .= $characters[rand(0, $charactersLength - 1)];
        }
      /*  if(!isset($_SESSION))
        {
            session_start();
        }*/

        session()->put($ref, $text);

        session()->save();

//        $_SESSION[$ref] = $text;

        header('Content-Type: image/png');
        // Replace path by your own font path
        $font = public_path().'/site/default/fonts/captcha.ttf';

        # Add Space
        $text = implode(' ', str_split($text));
        $text = trim($text);
        // Add the text
        imagettftext($im, 18, 0, 20, 25, $grey, $font, $text);
        #imagettftext($im, 18, 0, 20, 25, $grey, $font, $text);

        // Using imagepng() results in clearer text compared with imagejpeg()
        imagepng($im);
        imagedestroy($im);
        exit;
    }
}
