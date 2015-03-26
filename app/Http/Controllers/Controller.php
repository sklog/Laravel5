<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use View;
use DB;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	public $styles = array('/css/app.css');
	public function __construct() {
		View::composer ('app', function($view) { //app фишка laravel обращения к app.blade.php
			$view->with('styles', $this->styles); //app.blade.php будет вызываться вместе со стилями из переменной $styles
		});
		View::composer ('home', function($view) {
			$tovars=DB::table('products')->where('vip', '=', '2')->paginate(2); //get() или first() или paginate(10)
			$view->with('tovars', $tovars);
		});
	}

}
