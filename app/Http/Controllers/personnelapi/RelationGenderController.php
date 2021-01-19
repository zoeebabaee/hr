<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use HR\CurlImpersonated;
use HR\Company;



class RelationGenderController extends Controller
{
    use Login;


    public function __construct()
    {
     
    }

     public function saveRelationGender()
    {

        $token =Login::loginApi();
        $baseurl['gng_master_baseurl'] = Company::where('id',13)->first()->gng_master_baseurl;
        $contents =(json_decode(CurlImpersonated::gender($token ,$baseurl)))->data;
         $string= '<?php'." return[ \n "."'"."gender"."'"."=>["." \n";
         foreach($contents as $content){
             $string .="'".$content->id."' =>["."'"."itemName"."'". "=>".$content->itemName.", 'itemNumber"."'=>".$content->itemNumber.", 'name"."'=>'".$content->name."'],\n";
         }
         $string .="],";
         
         
        \Illuminate\Support\Facades\Storage::disk('gng')->put('gng.php',$string);
       
       /****************************************************/
        $contents =(json_decode(CurlImpersonated::relation($token ,$baseurl)))->data;
         $string= "\n'relation"."'"."=>["." \n";
         foreach($contents as $content){
             $string .="'".$content->id."' =>["."'"."itemName"."'". "=>".$content->itemName.", 'itemNumber"."'=>".$content->itemNumber.", 'name"."'=>'".$content->name."'], \n";
         }
         $string .="]];";
         
            // die(json_encode(\Config::get('gng_config.gng.gender.Men')));

        \Illuminate\Support\Facades\Storage::disk('gng')->append('gng.php',$string);



    }


}