@extends('layout.main')

@section('content')
	@if(Auth::check())
		<div id="question">
			@if(Auth::user()->birthday == date('Y-m-d'))
				<h1><span>"</span>Your Birthday today. What did you do to celebrate?<span>"</span></h1>
			@else
				<h1><span>"</span>{{ Question::dayQuestion() }}<span>"</span></h1>
			@endif
		</div>

		<div id="answers">
			<div id="old-answers">
				<ul>
					@foreach (Answer::dayAnswer() as $s)
						<li>
							<h3>{{ $s->year }}</h3>
							<p>{{ $s->answer }}</p>
						</li>
					@endforeach
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
	@else
		@include('layout.start')
	@endif
	@include('layout.notifications')
@stop