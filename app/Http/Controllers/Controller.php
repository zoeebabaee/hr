<?php



namespace HR\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        global $enum_last_degree;
        $enum_last_degree = [
            1=>'دیپلم',
            2=>'کاردانی',
            3=>'کارشناسی',
            4=>'کارشناسی ارشد',
            6=>'دکترا پیوسته',
            5=>'دکترا',];
    }
}
