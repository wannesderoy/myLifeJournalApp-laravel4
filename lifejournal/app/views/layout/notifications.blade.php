<script type="text/javascript">
var a = "{{ User::Notifications() }}"
var b = "{{ Answer::CheckTodayAnswer() }}";
if (b == 'false') {
	// hide form if answer to todays question is given
	$('#new-answers').remove();
	if(a == 'true')
		// call browser notification at end of the day when notifications is on and answer is
		var now = new Date();
		var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 18, 55, 0, 0) - now;
		if (millisTill10 < 0) {
		     millisTill10 += 86400000; // it's after 10am, try 10am tomorrow.
		}
		setTimeout(function() {
			notifications();
		}, millisTill10);
		// function that generates the desktop notifications
		function notifications() {
			var notify;
			//e.preventDefault();

			if (Notification.permission === 'default') {
				console.log("please allow notifications.");
			} else {
				notify = new Notification('New Message for {{ Auth::user()->name }}', {
					body: "You haven't answered your question today! '{{ Question::dayQuestion() }}'", 
					icon: '{{ Auth::user()->profile_pic }}',
					tag: '123456'
				});
				notify.setTimeout() = function() {
					window.location = '?Message=' +this.tag;
				}
			}	
		};
	};
</script>