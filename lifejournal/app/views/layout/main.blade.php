<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Life Journal App</title>
	{{ HTML::style('css/gumby.css') }}
	{{ HTML::style('stylesheets/style.css') }}
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/jquery-ui.min.js') }}
	{{ HTML::script('js/moment.min.js') }}
	{{ HTML::script('js/main.js') }}

	@if(Auth::check())
		<style>
		#profile_pic_header {
			width: 70px;
			height: 70px;
			border-radius: 150px;
			-webkit-border-radius: 150px;
			-moz-border-radius: 150px;
			background: url('{{ "/".Auth::user()->profile_pic }}');
			background-size: 70px 70px;
			background-repeat: no-repeat;
		}
		</style>
	@endif

</head>
<body>
	@if(Session::has('global'))
		<p>{{ Session::get('global') }}</p>
	@endif
	@if(Auth::check())
		@include('layout.navigation')
	@endif
	@yield('content')
</body>
</html>