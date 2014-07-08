$(document).ready(function($) {
	$('#btn-save').on('submit', function(){
        console.log("inside the first part shizzle");
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
 
        $.post(
            $(this).prop('action'),
            {
                "_token": $(this).find( 'input[name=_token]' ).val(),
                "setting_name": $('#setting_name').val(),
                "setting_value": $('#setting_value').val()
            },
            function(data) {
                //do something with data/response returned by server
                $('#after').html('your message was "stored" succesfully!');
                console.log('oubhaefoazhrg');
            },
            'json'
        );
 
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        return false;
	});
});