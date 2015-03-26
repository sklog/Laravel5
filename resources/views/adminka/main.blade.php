@extends('app')
@section('content')
	<h2>Система администрирования</h2>
	<h3 style=align:center>Форма добавления товара</h3>
	<form method='Post' action="{{asset('adminka')}}" enctype='multipart/form-data'>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class='container'>
			<div class='row'>
				<div class="form-group">
					<label for="name">Название</label>
					<input type="text" name='name' class="form-control" placeholder="Название товара">
				</div>
				<div class="form-group">
					<label for="body">Описание</label>
					<textarea class="form-control" name='body' placeholder="Описание..."></textarea>
				</div>
				<div class="form-group">
					<label for="picture">Изображение</label>
					<input type="file" name='picture'>
				</div>
				<div>
					<label for="showhide">ShowHide</label>
					<input type="checkbox" name='showhide' checked>Show
				</div>
				<div>
					<label for="price">Цена</label>
					<input type="text" name='price'>
				</div>
				<div>
					<label for='category'>Категория</label>
					<select name='category'>
						<option selected value='1'>Категория 1</option>
						<option value='2'>Категория 2</option>
					</select>
				</div>
				<div>
					<label for='vip'>VIP</label>
					<input type="radio" name='vip' value='1'>1
					<input type="radio" name='vip' value='2'>2
					<input type="radio" name='vip' value='3'>3
				</div>
				<button type="submit" class="btn btn-default">Добавить</button>
			</div>
		</div>
	</form>
	<br>
	<br>
	@if(isset($tovars))
		<table class=table>
			<thead>
				<tr>
					<th width='200px'>Изображение</th>
					<th>Название</th>
					<th>Категория</th>
					<th width='200px'>Действие</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tovars as $one)
					<tr>
						@if($one['picturesmall'])
							<?$pic="<img src='".asset('/media/images/products/'.$one['picturesmall'])."' />"?>
						@else
							<?$pic=''?>
						@endif
						<td><?=$pic?></td>
						<td>{{$one->name}}</td>
						<td>{{$one->cat_id}}</td>
						<td><a href='{{asset("adminka/edit/".$one->id)}}' title='редактировать'>Редактировать</a><br>
							@if($one->showhide=='show')
								<?$showhide='hide'; $textlink='Скрыть'?>
							@else
								<?$showhide='show'; $textlink='Отобразить'?>
							@endif
							<a href='{{asset("adminka/$showhide/".$one->id)}}' title='скрыть и отобразить'>{{$textlink}}</a><br>
							<a href='{{asset("adminka/delete/".$one->id)}}' title='удалить'>Удалить</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
	{!!$tovars->render()!!}
@endsection