<?php

Class Answer extends Eloquent {

	protected $fillable = array('answer', 'year', 'user_id', 'question_id');

	protected $table = "answers";

	// DEFINE RELATIONSHIPS --------------------------------------------------
	// each answer has 1 user
	public function user() {
		return $this->belongsToMany('User', 'user_id', 'question_id'); // this matches the Eloquent model
	}

	public function scopeDayAnswer($query) {
		$d = date("z");
		$u = Auth::user()->id;
		$answersRAW = $query->where('question_id', $d)->where('user_id', '=', $u)->get();
		$answers = $answersRAW->each(function($answerx) {
			$answerx->answer;
		});
		return $answers;
	}
}
