@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					@if(isset($tovars))
						@foreach($tovars as $one)
							<form method='Post' action='cart/add/{{$one->id}}'>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class='col-md-6'>
									<div><b>{{$one->name}}</b></div>
									<div>{{$one->body}}</div>
								</div>
								<div class='col-md-6'>
								<input type='number' name='colvo' value='1' min='1' max='1000' required>
								<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'> Купить</span></button>
								</div>
								<div style='clear:both;'>
							</form>
							<hr />
						@endforeach
						{!!$tovars->render()!!} <!--для пагинации, которая указана в BaseController (потом просто в Controller) вместо get()-->
					@endif
				</div>
				<a href="/adminka">Админка</a>
			</div>
		</div>
	</div>
</div>
@endsection
