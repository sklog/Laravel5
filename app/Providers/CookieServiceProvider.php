<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CookieServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('\App\Libs\Cookie'); //через bind сколько раз обращаемся, столько и объектов; через singleton всегда 1 объект независимо от кол-ва обращений
	}

}
