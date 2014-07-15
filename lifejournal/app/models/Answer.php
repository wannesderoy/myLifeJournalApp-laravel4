<?php

Class Answer extends Eloquent {
	protected $fillable = array('answer', 'year', 'user_id', 'question_id');
	protected $table = "answers";

	// DEFINE RELATIONSHIPS --------------------------------------------------
	// each answer has 1 user
	public function user() {
		return $this->belongsToMany('User', 'user_id', 'question_id'); // this matches the Eloquent model
	}

	// get today's answer
	public function scopeDayAnswer($query) {
		$answersRAW = $query->where('question_id', date("z")+1)->where('user_id', '=', Auth::user()->id)->orderBy('year', 'desc')->get();
		$answers = $answersRAW->each(function($answerx) {
			$answerx->answer;
		});
		return $answers;
	}
	// get the answers for the users birtyday -> has id 999
	public function scopeBdayAnswer($query) {
		$answersRAW = $query->where('question_id', '999')->where('user_id', '=', Auth::user()->id)->orderBy('year', 'desc')->get();
		$answers = $answersRAW->each(function($answerx) {
			$answerx->answer;
		});
		return $answers;
	}

	// check if user hase filled in answer to todays question
	public function scopeCheckTodayAnswer($query) {
		$check = $query->where('question_id', date("z")+1)->where('user_id', '=', Auth::user()->id)->where('year', date('Y'))->get();
		if ($check->isEmpty()) { 
			return 'true';
		} else {
			return 'false';
		}
	}
}
