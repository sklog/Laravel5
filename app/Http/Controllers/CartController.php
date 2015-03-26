<?php namespace App\Http\Controllers;

// вырезали на V: use DB;
use App;
use Input;
use Validator;

class CartController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex()
	{
//		$arr=[]; //массив
//		$db_arr=[];
//		foreach($_COOKIE as $key=>$value) {
//			$key=(int)$key;
//			if($key>0) {
//				$arr[$key]=$value;
//				$db_arr[]=$key;
//			}
//		}
//после создания провайдера закомментили

		$arr=\App::make('\App\Libs\Cookie')->get(); //добавили после создания провайдера
		$db_arr=\App::make('\App\Libs\Cookie')->get_db(); //добавили после создания провайдера
		$tovars=\App\Products::whereIn('id', $db_arr)->get();
		return view('cart')->with('tovars', $tovars)->with('arr', $arr);
	}
	
	public function getDelete($id=null)
	{
		setcookie($id, '', time()-1, '/');
		return redirect('cart');
	}
	
	public function postAdd($id=null)
	{
		//dd($_POST); //dd в laravel вместо print_r
		$colvo=$_POST['colvo'];
		setcookie($id, $colvo, time()+3600, '/'); //4 параметр - путь хранения кук
		return redirect('cart');
	}
	
	public function postOrder() {
		$cookies=\App::make('App\libs\Cookie')->get();
		$body=serialize($cookies);
		//dd($body);
		$zakaz=new \App\Orders;
		$data=Input::all();
		$rules=array(
			'phone'=>array('required')		
		);
		$validator=Validator::make($data, $rules);
		if($validator->fails()) {
			$errors=$validator->messages();
		}
		if(!empty($errors)) {
			return redirect('cart')->withErrors($errors);
		}
		$zakaz->body=$body;
		$zakaz->name=$data['name'];
		$zakaz->phone=$data['phone'];
		$zakaz->comment=$data['comment'];
		$zakaz->status='Новый';
		$zakaz->ip=$_SERVER['REMOTE_ADDR'];
		//$zakaz->created_at=data('Y-m-d h:i:s');
		//$zakaz->updated_at=data('Y-m-d h:i:s');
		$zakaz->save();
		foreach ($cookies as $cookie=>$colvo) {
			setcookie($cookie, '', time()-1, '/');
		}
		return redirect ('/');
	}
		
}
