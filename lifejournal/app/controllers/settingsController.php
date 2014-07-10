<?php

class settingsController extends BaseController {

	public function getSettings() {
		return View::make('settings');
	}

	public function postSettings() {
		if ( Session::token() !== Input::get( '_token' ) ) {
			return Redirect::route('settings')->with('global', 'There was a token mismatch');		
        } else {
			$v = Validator::make(Input::all(), array(
					'email' => 'email',
					'profilepicture'=>'image'
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
				if(Input::has('vibrate')) {
					$b = Input::get('vibrate');
					if ($b != Auth::user()->settings_vibrate) {
						$u->settings_vibrate = $b;
					}
				} else {
					$u->settings_vibrate = 0;
				}
				if(Input::has('sound')) {
					$c = Input::get('sound');
					if ($c != Auth::user()->settings_sound) {
						$u->settings_sound = $c;
					}
				} else {
					$u->settings_sound = 0;
				}
				if(Input::has('light')) {
					$d = Input::get('light');
					if($d != Auth::user()->settings_light){
						$u->settings_alertlight = $d;
					}
				} else {
					$u->settings_alertlight = 0;
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
					$size = Input::file('profilepicture')->getSize();
					if($size < 5000000000000) {
						$extension = Input::file('profilepicture')->getClientOriginalExtension();
						$path = "profile_pictures/" . User::SlugName()."/";
						$filename = Str::lower(Str::random(20, 'numeric'));		
						$filenameAndExtension = $filename . "." . $extension;	
						$fullFile = $path . $filenameAndExtension;
						$fileMove = Input::file('profilepicture')->move($path, $filenameAndExtension);
						$u->profile_pic = $fullFile;

							$image = new SimpleImage();
							$image->load($fullFile);
							$image->resizeToWidth(70);
							$image->save($fullFile);
								
							$im = new ImageManipulator($fullFile);
							$centreX = round($im->getWidth() / 2);
							$centreY = round($im->getHeight() / 2);

							$s = 70;
							$x1 = $centreX - $s;
							$y1 = $centreY - $s;

							$x2 = $centreX + $s;
							$y2 = $centreY + $s;

							$im->crop($x1, $y1, $x2, $y2);

							$im->save($fullFile);
							echo "HELLO WORLD!";
							
						////////////						
						
					} else {
						return Redirect::route('settings')->with('global', 'you profile picture is too big and has not been uploaded. Max allowed is 500kb -> yours = '.$size.'.');		
					}
				}
				if($u->save()) {
					return Redirect::route('settings')->with('global', 'you profile has been updated.');
				} else {
					return Redirect::route('settings')->with('global', 'you profile has NOT been updated.');
				}
			}
		}
	}
}