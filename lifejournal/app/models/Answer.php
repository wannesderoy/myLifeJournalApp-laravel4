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
		$d = date("z")+1;
		$u = Auth::user()->id;
		$answersRAW = $query->where('question_id', $d)->where('user_id', '=', $u)->orderBy('year', 'desc')->get();
		$answers = $answersRAW->each(function($answerx) {
			$answerx->answer;
		});
		return $answers;
	}
	// get the answers for the users birtyday -> has id 999
	public function scopeBdayAnswer($query) {
		$u = Auth::user()->id;
		$answersRAW = $query->where('question_id', '999')->where('user_id', '=', $u)->orderBy('year', 'desc')->get();
		$answers = $answersRAW->each(function($answerx) {
			$answerx->answer;
		});
		return $answers;
	}

	// check if user hase filled in answer to todays question
	public function scopeCheckTodayAnswer($query) {
		$u = Auth::user()->id;
		$d = date("z")+1;
		$y = date('Y');
		$check = $query->where('question_id', $d)->where('user_id', '=', $u)->where('year', $y)->get();
		if ($check->isEmpty()) { 
			$s = 'true';
			return $s;
		} else {
			$s = 'false';
			return $s;
		}
	}
}
