<?php
Class accountController extends BaseController {
	/**
	 * Start of signin
	 */
	public function getLogin() {
		return View::make('start.login');
	}

	public function postLogin() {
		if ( Session::token() != Input::get( '_token' ) ) {
			return Redirect::route('start-login')->with('global', 'There was a token mismatch, please try again.');		
        } else {
			// custom error messages for login
			$m = array(
				'email.required' 	=> '<span>We need to know your e-mail address.</span>',
				'email.email'		=> '<span>Your email is not an valid email adress.</span>',
	    		'password.required' => '<span>We need to know your password.</span>'
			);
			// Validate form input
			$v = Validator::make(Input::all(),
					array(
						'email' 	=> 'required|email', 
						'password' 	=> 'required' 
						), $m
					);

			// if validator fails
			if($v->fails() ) {
				// redirect to login with errors and unvalid input
				return Redirect::route('start-login') 
						->withErrors($validator) 
						->withInput(); 
			} else { 
				// if input is valid, store in $var
				$email_login 	= Input::get('email');
				$pass_login 	= Input::get('password');
				
				// attempt to login with credentials
				$auth = Auth::attempt(array( 
						'email' 	=> $email_login,
						'password' 	=> $pass_login
						)
				);

				if ($auth) {
					// if user login is valid, redirect to app home 
					return Redirect::route('home'); 
				} else { 
					// if user login is not valid, redirect to login with errors and input
					return Redirect::route('start-login')
							->with('global', 'Email or password wrong.')
							->withInput(); 
				}
			} 
		}
	}

	/**
	 * Start of register
	 */
	public function getRegister() {
		return View::make('start.register');
	}

	public function postRegister() {
		if ( Session::token() !== Input::get( '_token' ) ) {
			return Redirect::route('settings')->with('global', 'There was a token mismatch, please try again.');		
        } else {
			// custom error messages for register
			$messages = array(
				'name.required' 	=> '<span>Your name seems a bit weird and short.</span>',
	    		'email.required' 	=> '<span>We need to know your e-mail address.</span>',
	    		'birthday.required' => '<span>We need to know when to wish you a happy birthday!</span>',
	    		'password.required' => '<span>You need a secret knock or handshake.</span>'
			);
			// set the rules by which the form is validated
			$validator = Validator::make(Input::all(), array(
					'name' 		=> 'required',
					'email'		=> 'required|email|max:50|unique:users',
					'birthday'	=> 'required|date',
					'password'	=> 'required|min:3'
				), $messages
			);
			if($validator->fails()) {
				// if validator fails redirect user and tell him what's wrong
				return Redirect::route('start-register') 
						->withErrors($validator)
						->withInput();
			} else {
				// get the users input from the form
				$name 		= Input::get('name');
				$email 		= Input::get('email');
				$birthday 	= Input::get('birthday');
				$password 	= Hash::make(Input::get('password'));
				// create the user in the DB
				$user = User::create(array(
						'name' 			=> $name,
						'email' 		=> $email,
						'birthday' 		=> $birthday,
						'password' 		=> $password,
						'profile_pic' 	=> 'profile_pictures/default/default_profile_picture.jpg',
						'settings_all'	=> 1
					)
				);
				// check if user is created correctly
				if($user) {
					// send email to user to confirm his account
					Mail::send('emails.auth.start', array('name' => $name), function($message) use ($user) { 
						$message->to($user->email, $user->name)->subject('Thanks for registering on Life Journal');
					});

					// log the user in imediately after creating his account
					$auth = Auth::login($user);

					// validate login
					if($auth) {
						// after register, mail and login direct user to home
						return Redirect::route('home')
							->with('global','your account has been created, we send an email to you email adress with info.');
					} else {
						// if login fails
						return Redirect::route('start-login')
							->with('global','Something went wrong, please try to sign in.');
					}
				} else {
					// if register fails
					return Redirect::route('start-register')
							->with('global','Failed to create your account, please try again.');
				}
			}
		}	
	}
	/**
	 * Start of Legal routes
	 */
	public function getTerms() {
		return View::make('legal.terms-o-use');
	}
	public function getPrivacy() {
		return View::make('legal.privacy');
	}
}