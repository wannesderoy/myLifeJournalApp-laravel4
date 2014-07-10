<header>
	 	<div style="float: left; width: 70px;">
	 		<div id="profile_pic_header">
			</div>
		</div>

	 	<div style="float: left; width: 460px;">
	 		<div id="date">
				<h2>{{ date('jS \of F') }}</h2>
			</div>
		</div>

	 	<div style="float: right; width: 70px;">
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
		</div>
	 <br style="clear: left;" />
</header>