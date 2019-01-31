<?php

namespace App\Providers;

use App\Models\Issue;
use App\Models\Request;
use App\Models\Response;
use App\Models\Requirement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
			'request' => Request::class,
			'response' => Response::class,
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
