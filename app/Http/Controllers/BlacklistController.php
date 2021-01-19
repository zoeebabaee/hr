<?php

namespace HR\Http\Controllers;

use HR\Industry;
use HR\User;
use HR\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BlacklistController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {

        $users = UserProfile::where('id','>',83908)->where('created_at','>','2020-03-20')->get();

      /*  */


        foreach ($users as $user)
        {


                      if(json_decode(file_get_contents("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=$user->national_code"))->Result == 1)
                          $state = "blacklist";
                      else{
                          if(json_decode(file_get_contents("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$user->national_code"))->Status == 'فعال')
                              $state = 'active';
                          else if(json_decode(file_get_contents("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$user->national_code"))->Status == "")
                              $state='notexist';
                          else
                              $state = 'inactive';

                      }

            $data = array('status' => $state, "user_id" => $user->user_id);
            DB::table('BI_user_status')->insert($data);



        }

    }

    public function index3()
    {
        $users = User::where('created_at','>','2020-03-20')->take(4500)->get();
        foreach ($users as $user)
        {
            $check_exist_user_id = DB::table('BI_user_status1')->where('user_id', $user->id)->first()->id;
            if($check_exist_user_id > 0)
            {
                continue;
            }
            else
            {
                $national_code = $user->profile->national_code;

                if(json_decode(file_get_contents("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=$national_code"))->Result == 1)
                    $state = "blacklist";
                else{
                    $res = json_decode(file_get_contents("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$national_code"))->Status;
                    if( $res== 'فعال')
                        $state = 'active';
                    else if($res == "")
                        $state='notexist';
                    else
                        $state = 'inactive';

                }

                $data = array('status' => $state, "user_id" => $user->id);
                DB::table('BI_user_status1')->insert($data);
            }


        }

    }



    public function index()
    {
        //pages
        $i = 0;
        $j = 0;


for($page_count=1;$page_count<10;$page_count++)
{
    $start = $page_count;
    $end = $page_count+100;
        for($page = $start;$page<$end;$page++)
        {
            echo $page."\n";

            $items = json_decode(file_get_contents("http://172.31.2.18:1459/All/v1/default/GetResults/?page=$page&itemLimit=100"));

            foreach ($items as $item)
            {
                $national_code = trim($item->CodeMelli);
                if(!is_null($national_code))
                {

                    $user_id = UserProfile::where('national_code','like',"$national_code")->first()->user_id;
                    if( $user_id > 0)
                    {
                        
                        $check_exist_user_id = DB::table('BI_user_status')->where('user_id', $user_id)->where('company_id',$item->CompanyID)->first();
                        if(count($check_exist_user_id) > 0)
                        {
                             DB::table('BI_user_status')
                            ->where('id', $check_exist_user_id->id)
                            ->update(['status' => $item->Status]);
                        }
                        else
                        {


                            $j++;
                            $data = array('status' => $item->Status, "user_id" => $user_id,"company_name"=>$item->companyname,"company_id"=>$item->CompanyID);
                            DB::table('BI_user_status')->insert($data);
                        }

                    }
                    else
                    {
                        $i++;
                        continue;
                    }
                }
                else
                {
                    $i++;
                    continue;

                }

            }


        }
}
    }
    
    public function deactive()
    {
         $items = json_decode(file_get_contents("http://172.31.2.18:1459/deactive/default/GetResults/"));

            foreach ($items as $item)
            {
                $national_code = $item->Codemelli;
                
                $user_id = UserProfile::where('national_code','like',"$national_code")->first();
                    if( count($user_id) > 0)
                    {
                        $check_exist_user_id = DB::table('BI_user_status')->where('user_id', $user_id)->where('status',-1)->first();
                        if(count($check_exist_user_id) > 0)
                        {
                            continue;
                        }
                           else
                            {


                                DB::table('BI_user_status')
                                    ->where('id', $check_exist_user_id->id)
                                    ->update(['status' => $item->Status]);
                                Storage::append('BI_user_status.txt', "\n" . date('Y-m-d H:m') . '===>' . $national_code.' ==> status_old : '.$old_status.' new_stat : '.$item->Status);

                            }
                    }
            
                    else
                    continue;
            }
        
    }
    
 
    /*    public function check_myself_code()
    {
        $national_code=[];
        for($i=1;$i<736;$i++)
        {

            $items = json_decode(file_get_contents("http://172.31.2.18:1459/All/default/GetResults/?page=$i&itemLimit=100"));

            foreach ($items as $item)
            {
                $national_code[] = trim($item->CodeMelli);



            }
        }
        Storage::append('check_repeated.txt', "\n" . json_encode(array_count_values($national_code)));




    }*/
    
    
        public function check_myself_code()
    {
        for($i=1;$i<736;$i++)
        {

            $items = json_decode(file_get_contents("http://172.31.2.18:1459/All/default/GetResults/?page=$i&itemLimit=100"));

            foreach ($items as $item)
            {
                $national_code = trim($item->CodeMelli);
                if($national_code == '0079057004'){
                    var_dump($item);
                    echo $i."\n";
                    
                }


            }
        }


    }
    public function new_table()
    {
        $page = 1;



            $items = json_decode(file_get_contents("http://172.31.2.18:1459/All/v1/default/GetResults/?page=$page&itemLimit=1000"));

            foreach ($items as $item)
            {
                $national_code = trim($item->CodeMelli);
                if(!is_null($national_code))
                {

                    $user_id = UserProfile::where('national_code','like',"$national_code")->first()->user_id;
                    if( $user_id > 0)
                    {
                        echo "page: ".$page."   national_code   ".$national_code."      personel_id    ".$item->Personelid;
                      

                            $data = array('status' => $item->Status, "user_id" => $user_id,"company_name"=>$item->companyname,"company_id"=>$item->CompanyID);
                            DB::table('BI_user_status_zo')->insert($data);
                        }

                    
                    else
                    {
                        continue;
                    }
                }
                else
                {
                    continue;

                }

            }


        
    }

 public function zoee()
  {

//860

        for($page =352;$page<400;$page++)
        {
            echo $page."\n";
            

            $items = json_decode(file_get_contents("http://172.31.2.18:1459/All/v1/default/GetResults/?page=$page&itemLimit=100"));

            foreach ($items as $item)
            {
                $national_code1 = trim($item->CodeMelli);
                $national_code = preg_replace("/[^0-9]/", "",$national_code1);
                $check_exist_user_different_rec = DB::table('zoee_b')
                ->where('CodeMelli',$national_code)->where('CompanyID',$item->CompanyID)
                ->first();
                $created_at = date('Y-m-d H:m');
                if(count($check_exist_user_different_rec)>0 && $check_exist_user_different_rec->Status == $item->Status)
                {
                    //nothing
                    
                }
                
                else if(count($check_exist_user_different_rec)>0 && $check_exist_user_different_rec->Status != $item->Status)
                {
                    //update
                    $data = array('Status'=> $item->Status);
                    DB::table('zoee_b')
                        ->where('id', $check_exist_user_different_rec->id)
                        ->update($data);
                    Storage::append('BI_LOG.txt', "\n" . date('Y-m-d H:i:s') ." ==> page => ".$page. " id = ".$check_exist_user_different_rec->id .  "   :  changed".$check_exist_user_different_rec->Status ." ==> ".$item->Status);
    
                }
                elseif(count($check_exist_user_different_rec) == 0)
                {
                    if($check_exist_user<1)
                    {
                        
                        if(!is_null($national_code) || $national_code != "")
                        {
                            $user_id = UserProfile::where('national_code','like',"$national_code")->first()->user_id;
                            if($user_id > 0)
                            {
                                $data = array( "user_id" => $user_id,"companyname"=>$item->companyname,"CompanyID"=>$item->CompanyID
                        
                                ,"Personelid"=>$item->Personelid,"PersOnelName"=>$item->PersOnelName,"PersonelFamily"=>$item->PersonelFamily,"Status"=>$item->Status
                                ,"CodeMelli"=>$national_code,"keyid"=>$item->keyid,"Row_Number"=>$item->Row_Number,"page"=>$page,"created_at"=>$created_at
                                
                                );
                                DB::table('zoee_b')->insert($data);  
                            }
                        }
                    
                         
        
                    }
                }

                
                
                
               
               
               //if this record is exactly same as bi record
               /* $check_exist_user = DB::table('zoee1')
                ->where('CodeMelli',$item->CodeMelli)->where('CompanyID',$item->CompanyID)->where('Status',$item->Status)
                ->count();*/
/*            ->where('keyid',$item->keyid)->where('Row_Number',$item->Row_Number)->where('page',$page)
*/            
            }


        } 
        
        
        
        
        

    }







}
