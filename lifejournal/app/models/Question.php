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
	//get birthday question
	public function scopeBdayQuestion($query) {
		$b = $query->where('id','999')->first()->question;
		return $b;
	}

	// get the users birthday
	public function scopeHisBirthday($scope) {
		/*$b = Auth::user()->birthday;
		// bidrthday format = 1992-08-11
		$d = date('Y-m-d');
		if($b == $d) {

		}
		return $z;*/
	}
}