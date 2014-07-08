<?php
Class accountController extends BaseController {
	/**
	 * Start of signin
	 */
	public function getLogin() {
		return View::make('start.login');
	}

	public function postLogin() {
		$validator = Validator::make(Input::all(),
				array(
					'email' 	=> 'required|email', 
					'password' 	=> 'required' 
					)
				);
		if($validator->fails() ) {
			return Redirect::route('start-login') 
					->withErrors($validator) 
					->withInput(); 
		} else { 
				$auth = Auth::attempt(array( 
						'email' 	=> Input::get('email'), 
						'password' 	=> Input::get('password')
						)
			);
			if ($auth) { 
				return Redirect::route('home'); 
			} else { 
				return Redirect::route('start-login')
						->with('global', 'email/password wrong, or account not activated.'); 
			}
		} 
		return Redirect::route('start-login')
				->with('global', 'there was a problem signing you in.'); 
	}

	/**
	 * Start of register
	 */
	public function getRegister() {
		return View::make('start.register');
	}

	public function postRegister() {
		// custom error messages:
		$messages = array(
			'name.required' 	=> '<span>your name seems a bit weird and short<span>',
    		'email.required' 	=> '<span>We need to know your e-mail address!<span>',
    		'birthday.required' => '<span>we need to know when to wish you a happy birthday!<span>',
    		'password.required' => '<span>you need a secret knock or handshake<span>'
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
			$password 	= Input::get('password');
			// create the user in the DB
			$user = User::create(array(
					'name' 		=> $name,
					'email' 	=> $email,
					'birthday' 	=> $birthday,
					'password' 	=> Hash::make($password)
				)
			);
			// check if user is created correctly
			if ($user) {
				// log the user in imediately after creating his account
				$auth = Auth::attempt(array( 
						'name' 		=> $name, 
						'password' 	=> $password
					)
				);
				// check of user is logged in correctly
				if ($auth) {
					// after register and login direct user to home
					return Redirect::route('home')
						->with('global','your account has been created, we send an email to you email adress with info.');

					// send email to user to confirm his account
					Mail::send('emails.auth.start', array('name' => $name), function($message) use ($user) { 
					$message->to($user->email, $user->name)->subject('Activate your account');
					});
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