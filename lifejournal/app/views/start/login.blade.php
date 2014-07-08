@extends('layout.main')

@section('content')
	<div>
	<!-- Google login button -->
	</div>	
	<div>
		<p>OR</p>
	</div>
	<form action="{{URL::route('start-login')}}" method="post">

		<div class="field">
			<!-- Email adress -->
			<label for="email">E-mail adress</label>
			<input class="input" type="text" name="email" {{ (Input::old('email')) ? ' value ="'. e(Input::old('email')).'"' : '' }}>
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>

		<div class="field">
			<!-- Password -->
			<label for="password">Password</label>
			<input class="input" type="password" name="password">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		<!-- <div class="large danger btn icon-right entypo icon-check" onclick="javascript:this.form.submit();"><a href="#">Log in</a></div> -->
		<button class="btn btn-2 btn-2c" type="submit">login</button>
		{{Form::token() }}
	</form>

@stop