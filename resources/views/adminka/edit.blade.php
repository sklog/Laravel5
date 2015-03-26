@extends('app')
@section('content')
	<h2>Система администрирования</h2>
	Форма редактирования товара
	<form method='Post' action="{{asset('adminka/edit/'.$tovar->id)}} enctype='multipart/form-data'">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class='container'>
			<div class='row'>
				<div class="form-group">
					<label for="name">Название</label>
					<input type="text" name='name' class="form-control" value="{{$tovar['name']}}">
				</div>
				<div class="form-group">
					<label for="body">Описание</label>
					<textarea class="form-control" name='body'>{{$tovar['body']}}</textarea>
				</div>
				@if($tovar['picturesmall'])
					<?$pic="<img src='".asset('/media/images/products/'.$tovar['picturesmall'])."' />"?>
				@else
					<?$pic=''?>
				@endif
				<div><?=$pic?></div>
				<div class="form-group">
					<label for="picture">Изображение</label>
					<input type="file" name='picture'>
				</div>
				<div>
					<label for="showhide">виден на сайте</label>
					<input type="checkbox" name='showhide' <?=$tovar['showhide']=='show'?'checked':''?>>
				</div>
				<div>
					<label for="price">Цена</label>
					<input type="text" name='price' value="{{$tovar['price']}}">
				</div>
				<div>
					<label for='category'>Категория</label>
						<input type="text" name='price' value="{{$tovar['cat_id']}}">
				</div>
				<div>
					<label for='vip'>VIP</label>
					<input type="radio" name='vip' value='1' <?=$tovar['vip']=='1'?'checked':''?>>1
					<input type="radio" name='vip' value='2' <?=$tovar['vip']=='2'?'checked':''?>>2
					<input type="radio" name='vip' value='3' <?=$tovar['vip']=='3'?'checked':''?>>3
				</div>
				<button type="submit" class="btn btn-default">Сохранить изменения</button>
			</div>
		</div>
	</form>
@endsection