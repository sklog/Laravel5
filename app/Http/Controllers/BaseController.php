<?php namespace App\Http\Controllers;

// вырезали на V: use DB;

class BaseController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('home');
	}
//до V: $tovars=DB::table('products')->where('vip', '=', '2')
//->paginate(1); //или first() или paginate(10)
//return view('home')->with('tovars', $tovars);
	
	public function addProducts()
	{
		DB::table('products')->insert(array('name'=>'Холодильник',
											'body'=>'Морозит, две камеры',
											'picture'=>'',
											'picturesmall'=>'',
											'showhide'=>'show',
											'price'=>'100$',
											'cat_id'=>'1',
											'vip'=>'3',
											'created_at'=>date('y-m-d h:i:s'),
											'updated_at'=>date('y-m-d h:i:s')
		));
		return redirect('/');
	}
		
}
