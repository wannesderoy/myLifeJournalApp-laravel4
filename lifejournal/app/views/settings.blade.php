@extends('layout.main')

@section('content')
<div id="wrapper">
	{{ Form::open(array('action' => 'settingsController@postSettings', 'files' => true, 'class' => 'settings form')) }}
		<ul>
			<!-- NOTIFICATIONS -->
			<li id="notifications">
				<label for="notifications" class="label">Notifications</label>			
				<input class="checkbox field notifications" name="notifications" type="checkbox" value="0" id="notifications">						
			</li>
			<br>
			<!-- VIBRATE -->
			<li id="vibrate">
				{{ Form::label('vibrate', 'Vibrate', array('class' => 'label')); }}
				{{ Form::checkbox('vibrate', '1', true, array('class' => 'checkbox field vibrate')); }}
					@if($errors->has('vibrate'))
							{{ $errors->first('vibrate') }}
					@endif
			</li>
			<br>
			<!-- SOUND -->
			<li id="sound">
				{{ Form::label('sound', 'Sound', array('class' => 'label')); }}
				{{ Form::checkbox('sound', '1', true, array('class' => 'checkbox field sound')); }}
					@if($errors->has('sound'))
							{{ $errors->first('sound') }}
					@endif
			</li>
			<br>
			<!-- LIGHT -->
			<li id="light">
				{{ Form::label('light', 'Light', array('class' => 'label')); }}
				{{ Form::checkbox('light', 'light', true, array('class' => 'checkbox field light')); }}
					@if($errors->has('light'))
							{{ $errors->first('light') }}
					@endif
			</li>
			<br>
		<!-- /////////// USER INFORMATION \\\\\\\\\\ -->
			<li id="userInformation">
				<h4>user information</h4>
				<p>Leave fields untouched or blank to keep you information</p>
			</li>
			<!-- NAME -->
			<li id="name">
				{{ Form::label('name', 'Name', array('class' => 'label')); }}
				{{ Form::text('name', Auth::user()->name, array('class' => 'field name')); }}
					@if($errors->has('name'))
							{{ $errors->first('name') }}
					@endif
			</li>
			<br>
			<!-- EMAIL -->
			<li id="email">
				{{ Form::label('email', 'E-Mail Address', array('class' => 'label')); }}
				{{ Form::email('email', Auth::user()->email, array('class' => 'field email')); }}
					@if($errors->has('email'))
							{{ $errors->first('email') }}
					@endif
			</li>
			<br>
			<!-- BIRTHDAY -->
			<li id="birthday">
				{{ Form::label('birthday', 'Birthday', array('class' => 'label')); }}
				{{ HTML::date_mlj(); }}
					@if($errors->has('birthday'))
							{{ $errors->first('birthday') }}
					@endif
			</li>
			<br>
			<!-- PASSWORD -->
			<li id="password">
				{{ Form::label('password', 'Password', array('class' => 'label')); }}
				{{ Form::password('password', '', array('class' => 'field password')); }}
					@if($errors->has('password'))
							{{ $errors->first('password') }}
					@endif
			</li>
			<br>
			<!-- PROFILE PICTURE -->
			<li id="profilepicture">
				{{ Form::label('profilepicture', 'profile picture', array('class' => 'label')) }}
				{{ Form::file('profilepicture','', array('class' => 'field profilepicture')); }}
					@if($errors->has('profilepicture'))
							{{ $errors->first('profilepicture') }}
					@endif
			</li>
			<br>
			<!-- TOKEN -->
				{{ Form::token(); }}

			<!-- SUBMIT -->
			<li id="submit">
				{{ Form::submit('Save'); }}
			</li>
		</ul>
	{{ Form::close() }}
	
	<div>
		<!-- LOGOUT -->
		<div>
			<a href="{{ URL::route('logout') }}">
				Logout
			</a>
		</div>
	</div>
</div>
<script>
	var dnperm = document.getElementById('notifications');

	dnperm.addEventListener('click', function(e) {
		e.preventDefault();

		if(!window.Notification) {
			alert('Sorry, not supported.');
		} else {
			Notification.requestPermission(function(p) {
				if (p === 'denied') {
					console.log('you have denied notifications.');
				} else if (p === 'granted') {
					console.log('you have granted notifications.')
				}
			});
		}
	});
</script>
@stop