<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Life Journal App</title>
	{{ HTML::style('css/gumby.css') }}
	{{ HTML::style('css/web-style.css') }}
	{{ HTML::script('js/jquery.js') }}
</head>
<body>
	@if(Session::has('global'))
		<p>{{ Session::get('global') }}</p>
	@endif
	
	@include('layout.navigation')

	@yield('content')
</body>
</html>