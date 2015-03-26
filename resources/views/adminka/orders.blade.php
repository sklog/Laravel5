
@extends ('app')

@section('content')
	<div style="width:100%; margin-left:50px">
	<h2>Заказы</h2>
	<a href="/adminka">Товары</a> | <a href="/adminka/orders/">Заказы</a>
	<hr>	
	@if(isset($orders))
		<table class="ttable" border="1px" bordercolor="#dedede">
			<tr>
				<td>Заказ</td>
				<td>Телефон</td>
				<td>Комментарий</td>
				<td>Статус</td>
				<td>Дата</td>
				<td>IP</td>
				<td>Действия</td>
			</tr>
			@foreach ($orders as $one)						
			<tr>			
				<td>
				<?php
				$bodyunser=unserialize($one->body);
				$itogo=0;
				foreach ($bodyunser as $id=>$kolvo) {
					$temp=DB::table('products') -> where ('id','=',$id)-> first();
					if (!empty($temp->name)) {
						echo $temp->name.' - '.$kolvo.'шт. Цена - '.$temp->price.' руб. <br />';
					} else {
						echo 'error<br />';
					};
				$summa=$temp->price*$kolvo;	
				$itogo+=$summa;				
				}
				echo '<font style="color:red">Сумма заказа = '.$itogo.'</font>';?>
				
				</td>
				<td>{{$one->phone}}</td>
				<td>{{$one->comment}}</td>
				<td>
				<form method='post' action="{{asset('adminka/orders/status/'.$one->id)}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<label class="radio-inline">
					<input type="radio" name="status" id="inlineRadio1" value="new" <?=$one->status=='new'?'checked':''?>> new</input>
				</label>
				<label class="radio-inline">
					<input type="radio" name="status" id="inlineRadio1" value="sended" <?=$one->status=='sended'?'checked':''?>> sended</input>
				</label>
				<label class="radio-inline">
					<input type="radio" name="status" id="inlineRadio1" value="finished" <?=$one->status=='finished'?'checked':''?>> finished</input>
				</label>	
				<button type="submit" class="btn btn-default">Готово</button>
				</form>
				</td>
				<td>{{$one->created_at}}</td>
				<td>{{$one->ip}}</td>
				<td><a href="{{asset('adminka/orders/delete/'.$one->id)}}">X</a></td>
			</tr>
			@endforeach
		</table>
		{!!$orders->render()!!} <!--модуль пагинации -->
			
		
	@endif	
	</div>	
@endsection