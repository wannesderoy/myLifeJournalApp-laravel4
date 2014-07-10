<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('name', 'email', 'birthday', 'password', 'profile_pic', 'settings_all', 'settins_vibrate', 'settings_sound', 'settings_alertligth');

	use UserTrait, RemindableTrait;

	// every user has many answers
	public function answer() {
		return $this->hasMany('Answer'); // this matches the Eloquent model
	}

	// returns the users name in slug
	public function scopeSlugName($scope) {
		$a = Auth::user()->name;
		return Str::slug($a, '_');
	}

	public function scopeProfilePic($query) {
	}

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
