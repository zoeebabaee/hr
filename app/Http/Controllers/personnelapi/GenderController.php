<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use HR\CurlImpersonated;
use HR\Company;



class GenderController extends Controller
{
    use Login;


    public function __construct()
    {
     
    }

     public function saveGander()
    {
        //we use golrang ssystem for it alwase because ie doesnt different to another company in gender
        $token =Login::loginApi();
        $baseurl['gng_master_baseurl'] = Company::where('id',13)->first()->gng_master_baseurl;
        $contents =(json_decode(CurlImpersonated::gender($token ,$baseurl)))->data;
         $string= '<?php'." return[ \n "."'"."gender"."'"."=>["." \n";
         foreach($contents as $content){
             $string .="'".$content->itemName."' =>["."'"."id"."'". "=>".$content->id.", 'itemNumber=>"."'=>".$content->itemNumber.", 'name=>"."'=>'".$content->name."'],";
         }
         $string .="]];";
         
         
            // die(json_encode(\Config::get('gng_config.gng.gender.Men')));

        
       // \Illuminate\Support\Facades\Storage::disk('gng')->append('gng.php'," return[ \n gender=>".json_encode($contents)." \n];");
        \Illuminate\Support\Facades\Storage::disk('gng')->put('gng.php',$string);



    }


}