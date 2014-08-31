@extends('layout.main')

@section('content')

<div class="wrapper register">

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
			<input @if($errors->has('email')) class="error_field" @endif type="text" name="name" {{ (Input::old('name')) ? 'class="error_field" value ="'. e(Input::old('name')).'"' : '' }}>
			<br>
			@if($errors->has('name'))
				<div id="field_error">
					{{ $errors->first('name') }}
				</div>
			@endif
		</div>

		<div class="field">
			<!-- Email adress -->
			<label for="email">E-mail adress</label>
			<input @if($errors->has('email')) class="error_field" @endif type="text" name="email" {{ (Input::old('email')) ? ' value ="'. e(Input::old('email')).'"' : '' }}>
			<br>
			@if($errors->has('email'))
				<div id="field_error">
					{{ $errors->first('email') }}
				</div>
			@endif
		</div>

		<div class="field">
			<!-- Birthday -->
			<label for="birthday">Birthday</label>
			<input @if($errors->has('email')) class="error_field" @endif type="date" name="birthday" {{ (Input::old('birthday')) ? ' value ="'. e(Input::old('birthday')).'"' : '' }}>
			<br>
			@if($errors->has('birthday'))
				<div id="field_error">
					{{ $errors->first('birthday') }}
				</div>
			@endif
		</div>

		<div class="field">
			<!-- Password -->
			<label for="password">Password</label>
			<input @if($errors->has('email')) class="error_field" @endif type="password" name="password">
			<br>
			@if($errors->has('password'))
				<div id="field_error">
					{{ $errors->first('password') }}
				</div>
			@endif
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








