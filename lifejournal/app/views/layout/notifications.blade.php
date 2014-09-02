<script type="text/javascript">

// If notifications are on = true, of = false
var a = "{{ User::Notifications() }}"

// If todays question has been answered, false = not yet answered, true = answered
var b = "{{ Answer::CheckTodayAnswer() }}";

// var b = 'true';
console.log('1');

// if todays question has not been answered (false)
if (b == 'false') {
	console.log('2');
	// If notifications are true (on)
	if(a == 'true')
		console.log('3');
		// Call browser notification at end of the day when notifications is true on and answer is falses
		var now = new Date();
		var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 14, 22, 0, 0) - now;

		if (millisTill10 < 0) {
		     millisTill10 += 86400000;
		}
		// Run timeoute function on 'end' of the day
		setTimeout(function() {
			notifications();
		}, millisTill10);

		// Function that generates the desktop notifications
		function notifications() {
			var notify;
			//e.preventDefault();
			if (Notification.permission === 'default') {
				console.log("please allow notifications.");
			} else {
				notify = new Notification('Notification for {{ Auth::user()->name }}', {
					body: "You haven't answered your question today! '{{ Question::dayQuestion() }}'", 
					icon: '{{ Auth::user()->profile_pic }}',
					tag: '123456'
				});
				notify.setTimeout() = function() {
					window.location = '?Message=' +this.tag;
				}
			}	
		};
	} else {
		// Hide form if answer to todays question is given
		$('#new-answers').remove();
	}
</script>