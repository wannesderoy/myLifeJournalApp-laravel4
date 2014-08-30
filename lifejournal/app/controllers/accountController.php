<?php
Class accountController extends BaseController {
	/**
	 * Start of signin
	 */
	public function getLogin() {
		return View::make('start.login');
	}

	public function postLogin() {
		// custom error messages for login
		$messages = array(
			'email.required' 	=> '<span>We need to know your e-mail address.</span>',
			'email.email'		=> '<span>Your email is not an valid email adress.</span>',
    		'password.required' => '<span>We need to know your password.</span>'
		);
		$validator = Validator::make(Input::all(),
				array(
					'email' 	=> 'required|email', 
					'password' 	=> 'required' 
					), $messages
				);

		if($validator->fails() ) {
			return Redirect::route('start-login') 
					->withErrors($validator) 
					->withInput(); 
		} else { 
			$email_login = Input::get('email');
			$pass_login = Input::get('password');
			
			$auth = Auth::attempt(array( 
					'email' 	=> $email_login,
					'password' 	=> $pass_login
					)
			);

			if ($auth) { 
				return Redirect::route('home'); 
			} else { 
				return Redirect::route('start-login')
						->with('global', 'Email or password wrong.'); 
			}
		} 
		return Redirect::route('start-login')
				->with('global', 'There was a problem signing you in.'); 
	}

	/**
	 * Start of register
	 */
	public function getRegister() {
		return View::make('start.register');
	}

	public function postRegister() {
		// custom error messages for register
		$messages = array(
			'name.required' 	=> '<span>Your name seems a bit weird and short.</span>',
    		'email.required' 	=> '<span>We need to know your e-mail address.</span>',
    		'birthday.required' => '<span>We need to know when to wish you a happy birthday!</span>',
    		'password.required' => '<span>You need a secret knock or handshake.</span>'
		);
		// set the rules by which the form is validated
		$validator = Validator::make(Input::all(), array(
				'name' 		=> 'required|min:4',
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
					'profile_pic' 	=> 'profile_pictures/default/default_profile_picture.jpg'
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