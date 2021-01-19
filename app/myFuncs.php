<?php

namespace HR;

use function GuzzleHttp\Psr7\str;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class myFuncs extends Model
{
    public static function limit_words($string, $word_limit = 20)
    {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public static function percent_add($percent, $input)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        for ($i = strlen($str_tmp); $i < 5; $i++)
            $str_tmp .= '0';
        $str_tmp[$input - 1] = '1';
        return base_convert((integer)$str_tmp, 2, 10);
    }

    public static function percent_del($percent, $input)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        for ($i = strlen($str_tmp); $i < 5; $i++)
            $str_tmp .= '0';
        $str_tmp[$input - 1] = '0';
        return base_convert((integer)$str_tmp, 2, 10);
    }

    public static function is_complete($percent, $input)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        for ($i = strlen($str_tmp); $i < 5; $i++)
            $str_tmp .= '0';
        return intval($str_tmp[$input - 1]);
    }

    public static function is_accept($percent)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        if ($str_tmp[4] == '1')
            return true;
        else
            return false;
    }

    public static function percent_calc($percent)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        for ($i = strlen($str_tmp); $i < 5; $i++)
            $str_tmp .= '0';
        $result = 0;
        for ($i = 0; $i < 5; $i++)
            if ($str_tmp[$i] == '1') $result += 20;
        return $result;
    }

    public static function percent_status($percent)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        for ($i = strlen($str_tmp); $i < 4; $i++)
            $str_tmp .= '0';
        return strpos($str_tmp, '0') + 1;
    }

    public static function percent_state($percent)
    {
        $tmp = base_convert($percent, 10, 2);
        $str_tmp = (string)$tmp;
        for ($i = strlen($str_tmp); $i < 5; $i++)
            $str_tmp .= '0';
        return $str_tmp;
    }

    public static function farsi_numbers($num)
    {
        $ar1 = array("٠", "١", "٢", "٣", "۴", "۵", "۶", "٧", "٨", "٩");
        $ar2 = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        return str_replace($ar2, $ar1, $num);
    }

    public static function nums_to_en($num)
    {
        $persian_digits = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $arabic_digits = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $num = str_replace($arabic_digits, $persian_digits, $num);
        $persian_digits = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $english_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($persian_digits, $english_digits, $num);
    }

    public static function remove_input_mask($str)
    {

        return str_replace(array('(', ')', ' ', '-', '@'), array('', '', '', '', ''), $str);
    }

    public static function export_to_csv($header, $body, $file_name)
    {
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $file_name . \p3ym4n\JDate\JDate::now()->toDateString() . '.csv;');
        header('Content-Transfer-Encoding: binary');
        $fp = fopen('php://output', 'w');
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        fputcsv($fp, $header);
        foreach ($body as $line)
            fputcsv($fp, $line);
        fclose($fp);
    }

/*    public static function check_blacklist($code_meli)
    {
//        if($code_meli == '4270937270')
//            return 1;
        $result = null;
        if ($code_meli && strlen($code_meli) == 10) {
            $sub_folder_name = substr($code_meli, 0, 3);
            if (file_exists("check_blacklist/$sub_folder_name/$code_meli.txt") && time() - filemtime("check_blacklist/$sub_folder_name/$code_meli.txt") < 604800) {
                $myfile = fopen("check_blacklist/$sub_folder_name/$code_meli.txt", "r") or die("Unable to open file!");
                $result = fread($myfile, filesize("check_blacklist/$sub_folder_name/$code_meli.txt"));
                return $result;
            } else {
                if (!is_dir('check_blacklist'))
                    mkdir('check_blacklist');

                if (!is_dir("check_blacklist/$sub_folder_name"))
                    mkdir("check_blacklist/$sub_folder_name");
                if (self::checkRemoteFile("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=$code_meli"))
                    $result = file_get_contents("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=$code_meli");
                else
                    $result = 0;
                if ($result && json_decode($result))
                    $result = json_decode($result)->Result;
                file_put_contents("check_blacklist/$sub_folder_name/$code_meli.txt", $result);
            }
        }

        return $result;
    }*/
    
    public static function check_blacklist($code_meli)
    {
         $result = null;
        if ($code_meli && strlen($code_meli) == 10) {
            
                $results = json_decode(file_get_contents("http://172.31.2.18:1459/deactive/default/GetResults/"));
                $block_res = 0;
                foreach($results as $result)
                {
                    if($result->Codemelli == $code_meli)
                        $block_res = 1;
                    else continue;
                }
                
                
        }

        return $block_res;
        
    }

    public static function check_worker_state($code_meli)
    {

        $result = null;
        $sub_folder_name = null;
        $webservice = "http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$code_meli";

        if ($code_meli && strlen($code_meli) == 10) {
            $sub_folder_name = substr($code_meli, 0, 3);
//            $sub_folder_name = "code";
            $filename = "check_worker_state_kia/$sub_folder_name/$code_meli.txt";

            if (file_exists($filename) && time() - filemtime($filename) < 604800) {
//            if (file_exists($filename)) {

                $cache_file = fopen($filename, "r") or die("Unable to open file!");
                try {
                    $result = fread($cache_file, filesize($filename));
                } catch (\Exception $exception) {
                    $result = null;
                }
                if(is_null($result) || $result ==""){
                    $result = file_get_contents($webservice);
                    if (!is_null($result) && json_decode($result)) {
                        $result = json_decode($result)->Status;
                        file_put_contents($filename, $result);
                    }
                }
                return $result;

            }else{

                if (!is_dir('check_worker_state_kia'))
                    mkdir('check_worker_state_kia');

                if (!is_dir("check_worker_state_kia/$sub_folder_name"))
                    mkdir("check_worker_state_kia/$sub_folder_name");

                if (self::checkRemoteFile($webservice)) {
                    $result = file_get_contents($webservice);
                    if (!is_null($result) && json_decode($result)) {
                        $result = json_decode($result)->Status;
                    }
                    file_put_contents($filename, $result);
                    return $result;
                }else {
                    $result = null;
                    file_put_contents($filename, $result);
                    return $result;
                }
            }
        }
//        $result = file_get_contents($webservice);

//        if ($result && json_decode($result)) {
//            $result = json_decode($result)->Status;
//        }
//
//        if ($code_meli && strlen($code_meli) == 10) {
//            $sub_folder_name = substr($code_meli, 0, 3);
//            if (file_exists("check_worker_state/$sub_folder_name/$code_meli.txt") && time() - filemtime("check_worker_state/$sub_folder_name/$code_meli.txt") < 604800) {
//                $myfile = fopen("check_worker_state/$sub_folder_name/$code_meli.txt", "r") or die("Unable to open file!");
//                try {
//                    $result = fread($myfile, filesize("check_worker_state/$sub_folder_name/$code_meli.txt"));
//                } catch (\Exception $exception) {
//                    $result = null;
//                }
//                return $result;
//            } else {
//                if (!is_dir('check_worker_state'))
//                    mkdir('check_worker_state');
//
//                if (!is_dir("check_worker_state/$sub_folder_name"))
//                    mkdir("check_worker_state/$sub_folder_name");
//
//                if (self::checkRemoteFile("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$code_meli"))
//                    $result = file_get_contents(
//                        "http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$code_meli"
//                    );
//                else
//                    $result = 0;
//                if ($result && json_decode($result)) {
//                    $result = json_decode($result)->Status;
//                }
//
//                file_put_contents("check_worker_state/$sub_folder_name/$code_meli.txt", $result);
//            }
//        }

        return $result;
    }

    public static function RemoveSpecialChar($value)
    {
        $title = str_replace(array('\'', '"', ',', ';', '<', '>'), ' ', $value);
        return $title;
    }

    public static function spilit_string($str, $glue = '/')
    {
        $str = str_split((string)$str);
        $result = '';
        foreach ($str as $item)
            $result .= "/$item";

        return substr($result, 1);
    }

    public static function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1); //timeout in seconds

        $result = curl_exec($ch);
        curl_close($ch);


        if ($result !== FALSE)
            return true;
        else
            return false;
    }

    public static function resize($newWidth, $newHeight, $originalFile, $updated = 0, $force_renew = false, $extension = null)
    {

        if (!self::checkRemoteFile($originalFile) && !file_exists(ltrim($originalFile, '/')))
            return $originalFile;



        if (file_exists(ltrim($originalFile, '/')))
            $originalFile = ltrim($originalFile, '/');

        $cache_dir = 'cache/';
        if (!file_exists($cache_dir))
            mkdir($cache_dir);
        $cache_dir .= 'img/';
        if (!file_exists($cache_dir))
            mkdir($cache_dir);

        if (is_null($extension)) {
            $temp = explode('.', $originalFile);
            $extension = end($temp);
        }
        $new_name = md5($originalFile . $updated . $newWidth . $newHeight);

        # sub Folder:
        $cache_dir .= substr($new_name, 0, 4) . '/';
        if (!file_exists($cache_dir))
            mkdir($cache_dir);

        if (file_exists($cache_dir . $new_name . '.' . $extension) && !$force_renew)
            return '/' . $cache_dir . $new_name . '.' . $extension;

        $info = @getimagesize($originalFile);
        if (!$info)
            return false;

        if ($newWidth == null && $newHeight == null) {
            $newHeight = $info[1];
            $newWidth = $info[0];
        }

        if ($newWidth == null)
            $newWidth = intval($info[0] * $newHeight / $info[1]);

        if ($newHeight == null)
            $newHeight = intval($info[1] * $newWidth / $info[0]);

        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;
            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;
            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;
            default:
                throw new \Exception('Unknown image type.');
        }



        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        $tmp = imagecreatetruecolor($newWidth, $newHeight); // png ?: gif

        // start changes
        switch ($new_image_ext) {

            case 'gif':
            case 'png':
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($dimg , 0, 0, 0);
                // removing the black from the placeholder
                imagecolortransparent($tmp, $background);
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);
                break;

            default:
                break;
        }
        // end changes
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $image_save_func($tmp, $cache_dir . $new_name . '.' . $new_image_ext);

        return '/' . $cache_dir . $new_name . '.' . $new_image_ext;
    }

}
