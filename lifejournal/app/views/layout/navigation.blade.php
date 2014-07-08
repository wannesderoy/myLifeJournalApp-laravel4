<nav>
	<ul>
		<li><a href="{{ URL::route('home') }}">Home</a></li>	
		@if(!Auth::check())
			<li><a href="{{ URL::route('start-login') }}">Login</a></li>
			<li><a href="{{ URL::route('start-register') }}">Register</a></li>
		@else
			<li><a href="{{ URL::route('settings') }}">Settings</a></li>
		@endif
	</ul>
</nav>