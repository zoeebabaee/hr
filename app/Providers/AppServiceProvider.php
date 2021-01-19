<?php

namespace HR\Providers;

use HR\SMS;
use HR\Company;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
use HR\Setting\GlobalFooter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer(config('view_composers.latest_news'), function ($view) {
            $view->with('news', \HR\ViewComposers\LatestNews::index());
        });

        view()->composer(config('view_composers.events'), function ($view) {
            $view->with('events', \HR\ViewComposers\Events::index());
        });

        view()->composer(config('view_composers.latest_blog_contents'), function ($view) {
            $view->with('contents', \HR\ViewComposers\LatestBlogContents::index());
        });

        view()->composer(config('view_composers.recent_jobs'), function ($view) {
            $view->with('jobs', \HR\ViewComposers\TopTenJobs::index());
        });

        view()->composer('site.modules.side_top_jobs', function ($view) {
            $view->with('jobs', \HR\ViewComposers\TopTenJobs::index());
        });

        view()->composer('layout.site.default.global.footer', function ($view) {
            $view->with('jobs', \HR\ViewComposers\jobs_footer::index())->with('footer',GlobalFooter::all()->first());
        });
        
         view()->composer('*', function($view)
        {
            $view->with('filter_companies', Company::get());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
