@extends('layout.main')

@section('content')
	<h1>Settings page</h1>
	<div>
		{{ Form::open(array('action' => 'settingsController@postSettings', 'files' => true)) }}
		<!-- NOTIFICATIONS -->
			{{ Form::label('notifications', 'Notifications', array('class' => 'label')); }}
			{{ Form::checkbox('notifications', '1', true, array('class' => 'field notifications')); }}
				@if($errors->has('notifications'))
						{{ $errors->first('notifications') }}
				@endif
		<!-- VIBRATE -->
			{{ Form::label('vibrate', 'Vibrate', array('class' => 'label')); }}
			{{ Form::checkbox('vibrate', '1', true, array('class' => 'field vibrate')); }}
				@if($errors->has('vibrate'))
						{{ $errors->first('vibrate') }}
				@endif
		<!-- SOUND -->
			{{ Form::label('sound', 'Sound', array('class' => 'label')); }}
			{{ Form::checkbox('sound', '1', true, array('class' => 'field sound')); }}
				@if($errors->has('sound'))
						{{ $errors->first('sound') }}
				@endif
		<!-- LIGHT -->
			{{ Form::label('light', 'Light', array('class' => 'label')); }}
			{{ Form::checkbox('light', 'light', true, array('class' => 'field light')); }}
				@if($errors->has('light'))
						{{ $errors->first('light') }}
				@endif
	<!-- /////////// USER INFORMATION \\\\\\\\\\ -->
			<h3>user information</h3>
			<p>Leave fields untouched or blank to keep you information</p>
		<!-- NAME -->
			{{ Form::label('name', 'Name', array('class' => 'label')); }}
			{{ Form::text('name', Auth::user()->name, array('class' => 'field name')); }}
				@if($errors->has('name'))
						{{ $errors->first('name') }}
				@endif
		<!-- EMAIL -->
			{{ Form::label('email', 'E-Mail Address', array('class' => 'label')); }}
			{{ Form::email('email', Auth::user()->email, array('class' => 'field email')); }}
				@if($errors->has('email'))
						{{ $errors->first('email') }}
				@endif
		<!-- BIRTHDAY -->
			{{ Form::label('birthday', 'Birthday', array('class' => 'label')); }}
			{{ HTML::date_mlj(); }}
				@if($errors->has('birthday'))
						{{ $errors->first('birthday') }}
				@endif
		<!-- PASSWORD -->
			{{ Form::label('password', 'Password', array('class' => 'label')); }}
			{{ Form::password('password', '', array('class' => 'field password')); }}
				@if($errors->has('password'))
						{{ $errors->first('password') }}
				@endif
		<!-- PROFILE PICTURE -->
			{{ Form::label('profilepicture', 'profile picture', array('class' => 'label')) }}
			{{ Form::file('profilepicture','', array('class' => 'field profilepicture')); }}
				@if($errors->has('profilepicture'))
						{{ $errors->first('profilepicture') }}
				@endif

		<!-- TOKEN -->
			{{ Form::token(); }}

		<!-- SUBMIT -->		
			{{ Form::submit('Save'); }}
		{{ Form::close() }}
	</div>
	<div>
		<!-- LOGOUT -->
		<div><a href="{{ URL::route('logout') }}">Logout</a></div>
	</div>
@stop