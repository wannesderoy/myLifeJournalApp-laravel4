@extends('layout.main')

@section('content')
	@if(Auth::check())
		<div id="question">
			@if(Auth::user()->birthday == date('Y-m-d'))
				<div id="text"><h1>{{ Question::BdayQuestion() }}</h1></div>
			@else
				<div id="text"><h1>{{ Question::dayQuestion() }}</h1></div>
			@endif
		</div>

		<div id="answers">
			<div id="old-answers">
				<ul>
					@if(Auth::user()->birthday == date('Y-m-d'))
						@foreach (Answer::BdayAnswer() as $s)
							<li>
								<h3>{{ $s->year }}</h3>
								<p>{{ $s->answer }}</p>
							</li>
						@endforeach
					@else
						@foreach (Answer::dayAnswer() as $s)
							<li>
								<h3>{{ $s->year }}</h3>
								<p>{{ $s->answer }}</p>
							</li>
						@endforeach
					@endif
				</ul>
			</div>
			<form action="{{ URL::route('home-post') }}" method="post">
				<div>
					<label for="answer">answer:</label>
					<input type="text" name="answer" {{ (Input::old('answer')) ? ' value="'. Input::old('answer') .' " ' : '' }}>
				</div>
				<div>
					<input type="submit" value="Save">
				</div>
				{{ Form::token() }}
			</form>
		</div>
		@include('layout.notifications')
	@else
		@include('layout.start')
	@endif
	
@stop