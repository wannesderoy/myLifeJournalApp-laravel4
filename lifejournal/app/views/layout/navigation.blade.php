<header>
	<div id="profile_pic_header">
	</div>
	<div id="date">
		<h2>{{ date('jS \of F') }}</h2>
	</div>

<div id="menu">
	<div id="menu-trigger">
		<div class="div one"></div>
		<div class="div twoo"></div>
		<div class="div three"></div>
	</div>
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
</div>
</header>