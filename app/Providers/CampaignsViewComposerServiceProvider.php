<?php

namespace App\Providers;

use App\Campaign;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class CampaignsViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*',function($view){
            $campaigns = Campaign::orderby('numero','desc')->get();
            $view->with('campaigns',$campaigns);
        });
    }
}
