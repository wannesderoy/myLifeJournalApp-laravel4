@extends('layout.main')

@section('content')
	
		@if(Auth::check())
<div id="wrapper">
	<div id="messages">
		@if(Session::has('global'))
			  <li class="primary alert message">{{ Session::get('global')}}</li>
		@endif
	</div>
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
				{{ Form::open(array('action' => 'HomeController@postHome', 'files' => true, 'id' => 'answer-form')) }}
					<div>
						<input class="answer" type="text" name="answer" {{ (Input::old('answer')) ? ' value="'. Input::old('answer') .' " ' : '' }}>
					</div>

					<div id="take_photo">
						<label for="answer_image">
							<img src="images/image_icon.png" alt="image_icon" width="80">
						</label>
						<input type="file" id="answer_image" name="answer_image">	
					</div>

					<div>
						<input class="submit" type="submit" value="Save">
					</div>
					{{ Form::token() }}
				{{ Form::close() }}	
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
								<div id="answer_text">
									<h3>{{ $s->year }}</h3>
									<p>{{ $s->answer }}</p>
								</div>
								<img id="answer_pic" src="{{ $s->image }}" alt="answer_pic" width="150">
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