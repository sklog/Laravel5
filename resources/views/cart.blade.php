@extends('app')
@section('content')
	<h2>Корзина</h2>
	@if(isset($tovars))
		<table class=table>
			<thead>
				<tr>
					<th width='200px'>Изображение</th>
					<th>Название</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Сумма</th>
					<th width='200px'>Действие</th>
				</tr>
			</thead>
			<tbody>
				
				<? $itogo=0;?>
				@foreach($tovars as $one)
				<? $summa=$one->price*$arr[$one->id];?>
					<tr>
						@if($one->picturesmall)
							<?$pic="<img src='".asset('/media/images/products/'.$one->picturesmall)."' />"?>
						@else
							<?$pic=''?>
						@endif
						<td><?=$pic?></td>
						<td>{{$one->name}}</td>
						<td>{{$one->price}}</td>
						<td>
							<form method='Post' action='cart/add/{{$one->id}}'>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type='number' name='colvo' value='{{$arr[$one->id]}}' min='1' max='1000' required>
								<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'> Добавить</span></button>
								</div>
								<div style='clear:both;'>
							</form>
						</td>
						<td>{{$summa}}</td>
						<td><a href='cart/delete/{{$one->id}}'>Убрать из корзины</a></td>
					</tr>
					<? $itogo+=$summa;?>
				@endforeach
				<tr>
					<td colspan='4'><b>Итого:</b><td>
					<td colspan='2'>{{$itogo}}</td>
				</tr>
			</tbody>
		</table>
		<br><br>		
		@if(count($errors)>0)
			@foreach($errors->all() as $one)
				{{$one}}<br>
			@endforeach
		@endif
		<div class='container'>
			<div class='row'>
				<form method='Post' action="{{asset('cart/order')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="text" name='name' class="form-control" placeholder="Ваше имя" autocomplete="off">
					</div>
					<div class="form-group">
						<input type="text" name='phone' class="form-control" placeholder="Телефон" autocomplete="off">
					</div>
					<div class="form-group">
						<textarea name='comment' class="form-control" placeholder="Комментарий..." autocomplete="off"></textarea>
					</div>
					<button type="submit" class="btn btn-default">Подтвердить заказ</button>
				</form>
			</div>
		</div>
	@endif
@endsection