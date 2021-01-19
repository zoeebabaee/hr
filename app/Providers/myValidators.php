<?php

namespace HR\Providers;

use Illuminate\Support\ServiceProvider;

class myValidators extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('check_captcha', function ($attribute, $value, $parameters)
        {
           /* if(!isset($_SESSION))
                session_start();*/
            $var = session()->get($parameters[0]);
            if(strtolower($value) == strtolower($var)){

                    return 1;
                }
                return 0;
        });

        $this->app['validator']->extend('persian_date', function ($attribute, $value, $parameters)
        {
            try{
                \JDate::createFromFormat($parameters[0], $value);
                return 1;
            }catch (\Exception $exception){
                return 0;
            }
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
