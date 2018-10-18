<?php

namespace App\Providers;

use App\Models\Issue;
use App\Models\Requirement;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Relation::morphMap([
    		'issue' => Issue::class,
			'requirement' => Requirement::class
		]);
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
