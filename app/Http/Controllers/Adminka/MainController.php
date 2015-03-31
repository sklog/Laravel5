<?php namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Controller;
use Input; //для перехвата данных формы
use DB;
use Image;

class MainController extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->middleware('admin'); //до создания админа было 'auth'
	}
	
	public function getIndex()
	{
		$tovars=\App\Products::paginate(4); //сделать запрос в БД и через вью передать переменную tovars (можно DB::table('products')->paginate(4);)
		return view('adminka.main')->with('tovars', $tovars);
	}
	
	public function getEdit($id=null)
	{
		//echo $id;
		$tovar=\App\Products::find($id);
		return view('adminka.edit')->with('tovar', $tovar);
	}
	
	public function postEdit($id=null)
	{
		
		$data=Input::all();
			//dd($data);
       if($_FILES['picture']['error']==UPLOAD_ERR_OK) 
	   {
			$tmp_name=$_FILES['picture']['tmp_name']; //путь к временному файлу
			$name=$_FILES['picture']['name']; //имя загружаемого файла
			$dir=$_SERVER['DOCUMENT_ROOT'].'/media/images/products/'; //куда загружать файлы
			$pic_name=date('y_m_d_h_i_s').$name; //новое имя для файла
			if(is_uploaded_file($tmp_name)) 
			{
				move_uploaded_file($tmp_name, $dir.$pic_name); //откуда куда
				$img=Image::make($dir.$pic_name);
				$img->resize(150, null, function($constraint) 
				{
					$constraint->aspectRatio();
				});
				$pic_small='s_'.$pic_name;
				$img->save($dir.$pic_small);
			} 
		} 
		else 
		{
			$pic_name='';
			$pic_small='';
		}
		$tovar=\App\Products::find($id);
		if(isset($data['showhide'])) 
		{
			$showhide='show';
		} 
		else
		{
			$showhide='hide';
		}
		$tovar->name=$data['name'];
		$tovar->body=$data['body'];
		$tovar->showhide=$showhide;
		$tovar->price=$data['price'];
		$tovar->cat_id=$data['cat_id'];
		$tovar->vip=$data['vip'];
		$tovar->save();
		return redirect ('/adminka');
	}
	
	public function getDelete($id=null)
	{
		$tovar=\App\Products::find($id);
		if($tovar->picture) {
			@unlink($_SERVER['DOCUMENT_ROOT'].'/media/images/products/'.$tovar->picture);
		}
		if($tovar->picturesmall) {
			@unlink($_SERVER['DOCUMENT_ROOT'].'/media/images/products/'.$tovar->picturesmall);
		}
		$tovar->delete();
		return redirect ('/adminka');
	}
	
	public function getShow($id=null)
	{
		$tovar=\App\Products::find($id);
		$tovar->showhide='show';
		$tovar->save();
		return redirect ('/adminka');
	}
	
	public function getHide($id=null)
	{
		$tovar=\App\Products::find($id);
		$tovar->showhide='hide';
		$tovar->save();
		return redirect ('/adminka');
	}
	
	
	public function postIndex()
	{
		$data=Input::all();
		//echo '<pre>';
		//print_r ($data);
		//echo '</pre>';
        //dd($_FILES);
		if($_FILES['picture']['error']==UPLOAD_ERR_OK) 
		{
		//	print_r($_FILES);
		//} else {
		//	echo 'No file';
			$tmp_name=$_FILES['picture']['tmp_name']; //путь к временному файлу
			$name=$_FILES['picture']['name']; //имя загружаемого файла
			$dir=$_SERVER['DOCUMENT_ROOT'].'/media/images/products/'; //куда загружать файлы
			$pic_name=date('y_m_d_h_i_s').$name; //новое имя для файла
			if(is_uploaded_file($tmp_name)) 
			{
				move_uploaded_file($tmp_name, $dir.$pic_name); //откуда куда
				$img=Image::make($dir.$pic_name);
				$img->resize(150, null, function($constraint) 
												{
													$constraint->aspectRatio();
												});
				$pic_small='s_'.$pic_name;
				$img->save($dir.$pic_small);
			} 
		} 
		else 
		{
			$pic_name='';
			$pic_small='';
		}
		//exit;
		if(isset($data['showhide'])) 
		{
			$showhide='show';
		} 
		else 
		{
			$showhide='hide';
		}
		DB::table('products')->insert(array(
											'name'=>$data['name'],
											'body'=>$data['body'],
											'picture'=>$pic_name,
											'picturesmall'=>$pic_small,
											'showhide'=>$showhide,
											'price'=>$data['price'],
											'cat_id'=>$data['cat_id'],
											'vip'=>$data['vip']
		));
		return Redirect('/adminka');
	}

}