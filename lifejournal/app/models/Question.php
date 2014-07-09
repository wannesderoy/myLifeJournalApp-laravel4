<?php

Class Question extends Eloquent {

	protected $fillable = array('day', 'month', 'question');

	protected $table = "questions";
	
	// DEFINE RELATIONSHIPS --------------------------------------------------
	// each question has many answers
	public function question() {
		return $this->belongsTo('Answer'); // this matches the Eloquent model
	}
	
	public function scopeDayQuestion($query) {
		$d = date("z")+1;
		$q = $query->where('id',$d)->first()->question;
		return $q;
	}
}