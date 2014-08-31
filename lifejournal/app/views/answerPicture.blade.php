@extends('layout.main')

@section('content')
	<div class="wrapper answerpic">
		<div id="back_button">
			<a href="{{ URL::route('home') }}">
				<p>&#8592; Go back</p>
			</a>
		</div>
		<h1>
			{{ $question->question }}
		</h1>
		<img id="image_l" src="{{ "/".$answer->image_l }}" alt="image" width="600"/>
		<div id="answer">
			<p>{{ $answer->answer }}</p>
		</div>
	</div>
@stop