<a href="#" id="dntrigger">trigger</a>
<br>
{{ Answer::CheckTodayAnswer() }}

<script type="text/javascript">
/*
setDaysTimeout(function() {
     console.log('Four days gone');
*/


/*//*setTimeout(function() {
	console.log("{{ Answer::CheckTodayAnswer() }}")
},5000);*/

//////////////////////////--------------------------------------------------
	var dntrigger = document.getElementById('dntrigger')

	// Simulate an event
	dntrigger.addEventListener('click', function(e) {
		var notify;
		e.preventDefault();

		if (Notification.permission === 'default') {
			console.log("please allow notifications.");
		} else {
			notify = new Notification('New Message from {{ Auth::user()->name }}', {
				body: 'There still is an unanswered question waiting to be answered for you!<br>"{{ Question::dayQuestion() }}"', 
				icon: '{{ Auth::user()->profile_pic }}',
				tag: '123456'
			});
			notify.setTimeout() = function() {
				window.location = '?Message=' +this.tag;
			}
		}	
	});
//////////////////////////---------------------------------------------------


/*
},1);
*/
/*
// this function sets the timeout to one day ** production only, user for testing the normal setTimeout //
function setDaysTimeout(callback,days) {
    // 86400 seconds in a day
    var msInDay = 86400*1000; 

    var dayCount = 0;
    var timer = setInterval(function() {
        dayCount++;  // a day has passed

        if(dayCount == days) {
           clearInterval(timer);
           callback.apply(this,[]);
        }
    },msInDay);
}*/
</script>