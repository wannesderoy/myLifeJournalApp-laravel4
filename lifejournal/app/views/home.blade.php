@extends('layout.main')

@section('content')
	
		@if(Auth::check())
<div class="wrapper home">

	@if(Session::has('global'))
		<div id="messages">
			  <li class="primary alert message">{{ Session::get('global')}}</li>
		</div>
	@endif

		<div id="question">
			<table>
				<tbody>
					<tr>
						@if(User::UserBirthdate() == date('m-d'))
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
								<img src="images/image_icon.png" alt="image_icon" width="80"/>
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
					@if(User::UserBirthdate() == date('m-d'))
						@foreach (Answer::BdayAnswer() as $s)
							<li>
								<div id="answer_text">
									<h3>{{ $s->year }}</h3>
									<p>{{ $s->answer }}</p>
								</div>
								@if(isset($s->image_s))
									<a href="{{ URL::route('answer-image', $s->image_name ."/". $s->question_id) }}">
										<img id="answer_pic" src="{{ $s->image_s }}" alt="answer_pic" height="100">
									</a>
								@endif
							</li>
						@endforeach
					@else
						@foreach (Answer::dayAnswer() as $s)
							<li>
								<div id="answer_text">
									<h3>{{ $s->year }}</h3>
									<p>{{ $s->answer }}</p>
								</div>
								@if(isset($s->image_s))
									<a href="{{ URL::route('answer-image', $s->image_name ."/". $s->question_id) }}">
										<img id="answer_pic" src="{{ $s->image_s }}" alt="answer_pic" height="100">
									</a>
								@endif
							</li>
						@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
	<script>
	$(document).ready(function() {
		if($('#messages').length != 0) {
			setTimeout(function() {
				$('#messages').slideUp('slow');
			}, 7000);
		}
	});
	</script>
	@include('layout.notifications')
	@else
		@include('layout.start')
	@endif	
@stop