<script type="text/javascript">

// if notifications are on = true, of = false
var a = "{{ User::Notifications() }}"

// check if todays question has been answered
var b = "{{ Answer::CheckTodayAnswer() }}";

// if todays question has not been answered (false)
if (b == 'false') {
	
	console.log('DOUBLE YES');

	// hide form if answer to todays question is given
	$('#new-answers').remove();

	// if notifications are true (on)
	if(a == 'true')
	
		console.log('TRIPLE YES');

		// call browser notification at end of the day when notifications is on and answer is
		var now = new Date();
		var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 17, 05, 0, 0) - now;
		if (millisTill10 < 0) {
		     millisTill10 += 86400000;
		}

		//
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

// google+ signin button
/*
function signinCallback(authResult) {
  if (authResult['status']['signed_in']) {
    // Update the app to reflect a signed in user
    // Hide the sign-in button now that the user is authorized, for example:
    document.getElementById('signinButton').setAttribute('style', 'display: none');
  } else {
    // Update the app to reflect a signed out user
    // Possible error values:
    //   "user_signed_out" - User is signed-out
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    console.log('Sign-in state: ' + authResult['error']);
  }
}*/

</script>