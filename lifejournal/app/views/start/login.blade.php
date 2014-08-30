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
			<input @if($errors->has('email')) class="error_field" @endif type="text" name="email" {{ (Input::old('email')) ? 'value ="'. e(Input::old('email')).'"' : '' }}>
			<br>
			@if($errors->has('email'))
				<div id="field_error">
					{{ $errors->first('email') }}
				</div>
			@endif
		</div>

		<div class="field">
			<!-- Password -->
			<label for="password">Password</label>
			<input @if($errors->has('email')) class="error_field" @endif type="password" name="password" id="password">
			<br>
			@if($errors->has('password'))
				<div id="field_error">
					{{ $errors->first('password') }}
				</div>
			@endif
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