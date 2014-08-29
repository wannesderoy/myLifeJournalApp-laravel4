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
		<strong>Register</strong>
	</p>
</div>
<form action="{{URL::route('start-register')}}" method="post" id="register-form">
		
		<div class="field">
			<!-- First and Lastname -->
			<label for="name">First & Lastname</label>
			<input type="text" name="name" {{ (Input::old('name')) ? ' value ="'. e(Input::old('name')).'"' : '' }}>
			<br>
			<div id="field_error">
				@if($errors->has('name'))
					{{ $errors->first('name') }}
				@endif
			</div>
		</div>

		<div class="field">
			<!-- Email adress -->
			<label for="email">E-mail adress</label>
			<input type="text" name="email" {{ (Input::old('email')) ? ' value ="'. e(Input::old('email')).'"' : '' }}>
			<br>
			<div id="field_error">
				@if($errors->has('email'))
					{{ $errors->first('email') }}
				@endif
			</div>
		</div>

		<div class="field">
			<!-- Birthday -->
			<label for="birthday">Birthday</label>
			<input type="date" name="birthday" {{ (Input::old('birthday')) ? ' value ="'. e(Input::old('birthday')).'"' : '' }}>
			<br>
			<div id="field_error">
				@if($errors->has('birthday'))
					{{ $errors->first('birthday') }}
				@endif
			</div>
		</div>

		<div class="field">
			<!-- Password -->
			<label for="password">Password</label>
			<input type="password" name="password">
			<br>
			<div id="field_error">
				@if($errors->has('password'))
					{{ $errors->first('password') }}
				@endif
			</div>
		</div>	
 	<input class="large danger btn" type="submit" value='Register'/>
		{{ Form::token() }}
	</form>
	<div id="privacy-links">
		<p>
			By clicking on the above “Register” button you agree with our <a href="{{URL::route('legal-terms-o-use')}}">terms of use</a> and <a href="{{URL::route('legal-privacy')}}">privacy agreement</a>
		</p>
	</div>
	<div class="back register">
		<a href="{{ URL::route('home') }}">
			<p>&#8592; Go back</p>
		</a>
	</div>
</div>
@stop








