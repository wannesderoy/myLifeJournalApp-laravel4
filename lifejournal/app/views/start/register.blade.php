@extends('layout.main')

@section('content')
<p>hello world! @ register blade <p>

<!-- Google login button -->

<form action="{{URL::route('start-register')}}" method="post">
		
		<div class="field">
			<!-- First and Lastname -->
			<label for="name">First & Lastname</label>
			<input type="text" name="name" {{ (Input::old('name')) ? ' value ="'. e(Input::old('name')).'"' : '' }}>
			@if($errors->has('name'))
				{{ $errors->first('name') }}
			@endif
		</div>

		<div class="field">
			<!-- Email adress -->
			<label for="email">E-mail adress</label>
			<input type="text" name="email" {{ (Input::old('email')) ? ' value ="'. e(Input::old('email')).'"' : '' }}>
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>

		<div class="field">
			<!-- Birthday -->
			<label for="birthday">Birthday</label>
			<input type="date" name="birthday" {{ (Input::old('birthday')) ? ' value ="'. e(Input::old('birthday')).'"' : '' }}>
			@if($errors->has('birthday'))
				{{ $errors->first('birthday') }}
			@endif
		</div>

		<div class="field">
			<!-- Password -->
			<label for="password">Password</label>
			<input type="password" name="password">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
<!-- medium default btn icon-right entypo icon-camera
 -->		
 	<input class="large danger btn icon-right entypo icon-camera" type="submit" value='Register'/>
		{{ Form::token() }}
	</form>
	<div>
		<p>
			By clicking on the above “Register” button you agree with our <a href="{{URL::route('legal-terms-o-use')}}">terms of use</a> and <a href="{{URL::route('legal-privacy')}}">privacy agreement</a>
		</p>
	</div>
@stop








