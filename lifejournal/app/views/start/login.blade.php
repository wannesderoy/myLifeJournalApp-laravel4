@extends('layout.main')

@section('content')
<div id="wrapper">

	@if(Session::has('global'))
		<div id="error_message_start">
			<p>{{ Session::get('global')}}</p>
		</div>
	@endif
	
<div id="start-title">
	<p>
		<strong>Log in</strong>
	</p>
</div>	
	<form action="{{URL::route('start-login')}}" method="post" id="login-form">

		<div class="field">
			<!-- Email adress -->
			<label for="email">E-mail adress</label>
			<input class="field email" type="text" name="email" {{ (Input::old('email')) ? ' value ="'. e(Input::old('email')).'"' : '' }}>
			<br>
			<div id="field_error">
				@if($errors->has('email'))
					{{ $errors->first('email') }}
				@endif
			</div>
		</div>

		<div class="field">
			<!-- Password -->
			<label for="password">Password</label>
			<input class="field password" type="password" name="password" id="password">
			<br>
			<div id="field_error">
				@if($errors->has('password'))
					{{ $errors->first('password') }}
				@endif
			</div>
		</div>

 		<input class="large danger btn" type="submit" value='Log in'/>
		{{Form::token() }}
	</form>
	<div class="back login">
		<a href="{{ URL::route('home') }}">
			<p>&#8592; Go back</p>
		</a>
	</div>
</div>
@stop