<a href="#" id="dnperm">request permission</a>
	|
<a href="#" id="dntrigger">trigger</a>
<br>
<p>{{ date('Y-m-d'); }}</p>

<script type="text/javascript">
	var d = moment().format('DDD');
	d - 1;
	console.log(d+' = is volgens google de juiste dag van het jaar.');


	var dnperm = document.getElementById('dnperm');
	var dntrigger = document.getElementById('dntrigger');

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

	// Simulate an event
	dntrigger.addEventListener('click', function(e) {
		var notify;

		e.preventDefault();

		if (Notification.permission === 'default') {
			console.log("please allow notifications.");
		} else {
			notify = new Notification('New Message from {{ Auth::user()->name }}', {
				body: '{{ Question::dayQuestion() }}', 
				icon: '{{ Auth::user()->profile_pic }}',
				tag: '123456'
			});
			notify.setTimeout() = function() {
				window.location = '?Message=' +this.tag;
			}
		}	
	});

</script>