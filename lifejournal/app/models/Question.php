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
		$q = $query->where('id',date("z")+1)->first()->question;
		// if question is to long, reduce font-size
		if(strlen($q) > 75) { 
			return "<span style='font-size:42px;'>".$q."</span>";
		} else {
			return $q;
		}
	}
	// get birthday question
	public function scopeBdayQuestion($query) {
		$b = $query->where('id','=', '999')->first()->question;
		return $b;
	}
}