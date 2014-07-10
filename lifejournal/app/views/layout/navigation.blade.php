<header>
	 	<div style="float: left; width: 70px;">
	 		<a href="{{ URL::route('home') }}">
	 			<div id="profile_pic_header">
				</div>
			</a>
		</div>
		
	 	<div style="float: left; width: 460px;">
	 		<a href="{{ URL::route('home') }}">
	 			<div id="date">
					<h2>{{ date('jS \of F') }}</h2>
				</div>
			</a>
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
						<li>
							<a href="{{ URL::route('home') }}">
								<img src="/images/home_icon.png" alt="home_icon" width="80"/>
								<span>Home</span>
							</a>
						</li>

						@if(!Auth::check())

							<li>
								<a href="{{ URL::route('start-login') }}">
									<span>Login</span>
								</a>
							</li>
							<li>
								<a href="{{ URL::route('start-register') }}">
									<span>Register</span>
								</a>
							</li>

						@else
							<a href="{{ URL::route('settings') }}">
								<li>
									<img src="/images/settings_icon.png" alt="settings_icon" width="80"/>
									<span>Settings</span>
								</li>
							</a>
							<a href="{{ URL::route('calendar') }}">
								<li>
									<img src="/images/calendar_icon.png" alt="calendar_icon" width="80"/>
									<span>Calendar</span>
								</li>
							</a>

						@endif
					</ul>
				</nav>
			</div>
		</div>
	 <br style="clear: left;" />
</header>