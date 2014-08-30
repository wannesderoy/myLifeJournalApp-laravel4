@extends('layout.main')

@section('content')
<div id="wrapper">
	<div id="messages">
		@if(Session::has('global'))
		<li class="primary alert message">{{ Session::get('global')}}</li>
		@endif
	</div>
	{{ Form::open(array('action' => 'settingsController@postSettings', 'files' => true, 'class' => 'settings form')) }}
		<ul>
			<!-- NOTIFICATIONS -->
			<li id="notifications">
				<p class="label">Notifications</p>
				<div class="onoffswitch" style="float:right;">
				    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked='checked'>
				    <label class="onoffswitch-label" for="myonoffswitch">
				        <span class="onoffswitch-inner">
				            <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
				            <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
				        </span>
				    </label>
				</div>
			</li>
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
				{{ Form::password('password', array('class' => 'field password')); }}
					@if($errors->has('password'))
							{{ $errors->first('password') }}
					@endif
			</li>
			<br>
			<!-- PROFILE PICTURE -->
			<li id="profilepicture">
				{{ Form::label('profilepicture', 'profile picture', array('class' => 'label')) }}
				{{ Form::file('profilepicture', array('class' => 'field profilepicture file input')); }}
					@if($errors->has('profilepicture'))
							{{ $errors->first('profilepicture') }}
					@endif
			</li>
			<br>
			<!-- TOKEN -->
				{{ Form::token(); }}

			<!-- SUBMIT -->
			<li id="submit">
				<input class="large danger btn settings_save" type="submit" value='Save'/>
				<!-- {{ Form::submit('Save', array('class' => 'large default btn settings_save')); }} -->
			</li>
			<li>
				<div id="logout">
					<!-- LOGOUT -->
					<div class="large danger btn logout">
						<a href="{{ URL::route('logout') }}">
							Logout
						</a>		
					</div>
				</div>
			</li>
		</ul>
	{{ Form::close() }}	
</div>
<script>
 	// grant or resist permission for notifications via button
 	/*
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
*/
</script>
@stop