<?php

namespace App\Providers;

use App\Models\Information;
use Illuminate\Support\ServiceProvider;

class ViewShareServiceProvider extends ServiceProvider
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
        $informations = Information::get();
        $information = [];
        foreach ($informations as $item){
            $information[$item->slug] = $item->content;
        }

        view()->share('information', $information);

    }
}
