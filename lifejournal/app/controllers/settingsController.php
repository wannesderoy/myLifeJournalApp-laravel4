<?php

class settingsController extends BaseController {

	public function getSettings() {
		return View::make('settings');
	}

	public function postSettings() {
		if ( Session::token() !== Input::get( '_token' ) ) {
			return Redirect::route('start-register')->with('global', 'There was a token mismatch, please try again.');		
        } else {
			$v = Validator::make(Input::all(), array(
					'email' 			=> 'email',
					'profilepicture'	=> 'image'
				));
			if($v->fails()) {
				return Redirect::route('settings')
						->with('global', 'there was a problem validating your input')
						->withErrors($v)
						->withInput();
			} else {
				// current user id
				$u = User::Find(Auth::user()->id);

				// settins
				if(Input::has('notifications')) {
					$a = Input::get('notifications');
					if ($a != Auth::user()->settings_all) {
						$u->settings_all = $a;
					}
				} else {
					$u->settings_all = 0;
				}

				// user information
				if(Input::has('name')) {
					$name = Input::get('name');
					if ($name != Auth::user()->name) {
						$u->name = $name;
					}
				}
				if(Input::has('email')) {
					$email = Input::get('email');
					if ($email != Auth::user()->email) {
						$u->email = $email;
					}
				}
				if(Input::has('birthday')) {
					$birthday = Input::get('birthday');
					if ($birthday != Auth::user()->birthday) {
						$u->birthday = $birthday;
					}
				}
				if(Input::has('password')) {
					$password = Input::get('password');
					if ($password != Auth::user()->password) {
						$u->password = $password;
					}
				}
				
				// profile picture
				if (Input::hasFile('profilepicture')) {
					$file = Input::file('profilepicture');
					$size = $file->getSize();
					if($file->isValid()) {
						if($size < 5000000) {

							$profilepicture_image 	= ImageHandler::profile_picture($file);
							
							$u->profile_pic 		= $profilepicture_image;

						} else {
							return Redirect::route('settings')->with('global', 'You image is too big and has not been uploaded. Max allowed is 500kb -> yours = '.$size.'.');		
						}
					} else {
						return Redirect::route('settings')->with('global', 'Your image is not a valid image.');
					}
				}
				if($u->save()) {
					return Redirect::route('settings')->with('global', 'you profile has been updated.');
				} else {
					return Redirect::route('settings')->with('global', 'you profile has not been updated.');
				}
			}
		}
	}
}