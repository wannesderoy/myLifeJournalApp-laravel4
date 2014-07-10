@extends('layout.main')

@section('content')
	<div id="wrapper">
		@if(Auth::check())

		<div id="question">
			<table>
				<tbody>
					<tr>
						@if(Auth::user()->birthday == date('Y-m-d'))
							<td><h1>{{ Question::BdayQuestion() }}</h1></td>
						@else
							<td><h1>{{ Question::dayQuestion() }}</h1></td>
						@endif
					</tr>
				</tbody>
			</table>
		</div>

		<div id="answers">
			<div id="new-answers">
				<h3>{{ date("Y") }}</h3>
				<form action="{{ URL::route('home-post') }}" method="post">
					<div>
						<input type="text" name="answer" {{ (Input::old('answer')) ? ' value="'. Input::old('answer') .' " ' : '' }}>
					</div>
					<div>
						<input type="submit" value="Save">
					</div>
					{{ Form::token() }}
				</form>
			</div>
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
		</div>
	</div>
	@include('layout.notifications')
	@else
		@include('layout.start')
	@endif	
@stop