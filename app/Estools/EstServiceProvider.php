<?php namespace EstTools;

use Illuminate\Support\ServiceProvider;

class EstServiceProvider extends ServiceProvider {

	public function boot()
	{

	}

	public function register()
	{
        $this->app->bind("est",function(){
            return new Est();
        });
	}

}
