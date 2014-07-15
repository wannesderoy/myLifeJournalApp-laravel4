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
		return Str::slug(Auth::user()->name, '_');
	}
	// return if notifications are on or off
	public function scopeNotifications($query) {
		if(Auth::user()->settings_all == 1) {
			return 'true';
		} else if(Auth::user()->settings_all == 0){
			return 'false';
		}
	}
	// return if notifications is on or of on settings page
	public function scopeNotificationsCheckox($query) {
		if(Auth::user()->settings_all == 1) {
			return 'checked=checked';
		} else {
			return ' ';
		}
	}
/*
	public function scopeProfilePic($query) {

	}*/
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
