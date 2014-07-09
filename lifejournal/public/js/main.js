$(document).ready(function($) {

    ////// MOBILE MENU SHOW/HIDE
    var trigger = false;
    $('#menu-trigger').click(function() {
        if(trigger == false) {
            $('nav').css('display', 'block');
            $('#mobile-menu-trigger').css('background-color', '#53bdae');
            $('.bar').css('background-color', '#fff');
            $('.text').css('color', '#fff');
            trigger = true
        } else if (trigger == true) {
            $('nav').css('display', 'none');
            $('#mobile-menu-trigger').css('background-color', '#fff');
            $('.bar').css('background-color', '#535353');
            $('.text').css('color', '#535353');
            trigger = false;
        }
    });


    ////// AJAX IN LARAVEL SHIZZLE
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