@extends('layout.main')

@section('content')
	<h1>Calendar Homepage</h1>	
	<div id="calendar"></div>
	<script>
    $('#calendar').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    
	$('.ui-datepicker-calendar thead').html('');
    
</script>

@stop