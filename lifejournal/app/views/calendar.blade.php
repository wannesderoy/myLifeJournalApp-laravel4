@extends('layout.main')

@section('content')

<div id="calendar"></div>

<script>
    $('#calendar').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $('.ui-datepicker-year').remove();
	$('.ui-datepicker-calendar thead').remove();
    $('.ui-datepicker-other-month').html('');
    $('td').removeAttr('data-event');
    
</script>

@stop