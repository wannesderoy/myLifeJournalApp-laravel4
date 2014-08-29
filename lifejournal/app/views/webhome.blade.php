<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Life Journal</title>
	{{ HTML::style('stylesheets/webstyle.css') }}	
</head>
<body>
	<div id="web-wrapper">
		<section id="header">
			<div class="content">
				<div id="title">
					<h1>Life Journal</h1>
				</div>
				<nav id="menu">
					<ul>
						<li class="item first home active"><a data-scroll data-options="easing: easeInOutQuart" href="#home">Home</a></li>
						<li class="item second about"><a data-scroll data-options="easing: easeInOutQuart" href="#about">About</a></li>
						<li class="item third contact"><a data-scroll data-options="easing: easeInOutQuart" href="#contact">Contact</a></li>
						<li class="item last"><a href="{{ URL::route('start-login') }}">Sign in</a></li>
					</ul>
				</nav>
			</div>
		</section>
		<section id="home" data-stellar-background-ratio="0.5">
			<div class="content">
				<div id="iphone" data-stellar-ratio="2">
					<img src="../images/iphones-0{{mt_rand(1,4)}}.png" alt="iphone" width="300">
				</div>
				<div id="slogan">
					<h2>Finding answers is about <br> asking the right questions</h2>
				</div>
				<a href="{{ URL::route('home') }}">
					<div id="action">
						<p>Start answering now!</p>
					</div>
				</a>
			</div>
		</section>
		<section id="about" data-stellar-background-ratio="0.5">
			<div class="content">
				<div class="quote left">
					<img src="images/home_icon.png" alt="home_icon">
					<p>Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo. parturient  porttitor.</p>
				</div>

				<div class="quote middle">
					<img src="images/calendar_icon.png" alt="calendar_icon">
					<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
				</div>
				
				<div class="quote right">
					<img src="images/settings_icon.png" alt="settings_icon">
					<p>Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque .</p>
				</div>
			</div>
		</section>
		<section id="contact">
			<div class="content">
				<div id="repo">
					<ul>
						<li>
							<a href="https://github.com/wannesderoy/myLifeJournalApp-laravel4" target="_blank"><p>View this project on github</p><i class="devicons github"></i></a>
						</li>
					</ul>
				</div>
				<div id="tech">
					<ul>
						<li><a href="http://laravel.com" target="_blank" class="devicons laravel"></a></li>
						<li><a href="http://www.mysql.com/" target="_blank" class="devicons sql"></a></li>
						<li><a href="http://php.net" target="_blank" class="devicons php"></a></li>
						<li><a href="http://compass-style.org" target="_blank" class="devicons compass"></a></li>
						<li><a href="http://www.wikiwand.com/nl/JavaScript" target="_blank" class="devicons js"></a></li>
						<li><a href="http://jquery.com/" target="_blank" class="devicons jquery"></a></li>
					</ul>
				</div>
				<div id="contact-info">
					<ul>
						<li><a class="sm-icon twitter" target="_blank" href="http://twitter.com/zwannes"><img src="images/sm_icons-01.png" alt="twitter" width="50"></a></li>
						<li><a class="sm-icon facebook" target="_blank" href="http://facebook.com/wannes.de.roy"><img src="images/sm_icons-02.png" alt="facebook" width="50"></a></li>
						<li><a class="sm-icon instagram" target="_blank" href="http://instagram.com/wannesderoy"><img src="images/sm_icons-03.png" alt="instagram" width="50"></a></li>
						<li><a class="sm-icon linkedin" target="_blank" href="https://www.linkedin.com/in/wannesderoy"><img src="images/sm_icons-04.png" alt="linkedin" width="50"></a></li>
					</ul>
				</div>
				<div id="copy">
					<h3>© {{ date('Y') }} -  <a href="http://wannesderoy.be">Wannes De Roy</a></h3>
				</div>
			</div>
		</section>
	</div>
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/jquery.stellar.min.js') }}
	{{ HTML::script('js/waypoints.min.js') }}
	{{ HTML::script('js/waypoints.sticky.min.js') }}
	{{ HTML::script('js/smooth-scroll.js') }}
	<script type="text/javascript">
		$(document).ready(function() {
			$('#header').waypoint('sticky');
			$(window).scroll(function() {
				if ($(this).scrollTop() > 1) {  
    				$('#header').addClass("sticky");
  				} else {
				    $('#header').removeClass("sticky");
  				}
			});
			$.stellar();
			$('#home').waypoint(function() {
				$("#menu li").removeClass("active");
				$(".home").addClass("active");	
			});
			$('#about').waypoint(function() {
				$("#menu li").removeClass("active");
				$(".about").addClass("active");	
			},{ offset: '120px' } );
			$('#contact').waypoint(function() {
				$("#menu li").removeClass("active");
				$(".contact").addClass("active");	
			},{ offset:'400px' });
			if ($(window).width() >= 767){
				smoothScroll.init({
					speed: 1000,
					easing: 'easeInOutCubic',
					offset: 50,
					updateURL: false,
					callbackBefore: function ( toggle, anchor ) {},
					callbackAfter: function ( toggle, anchor ) {}
				});
			}
		});
	</script>
</body>
</html>