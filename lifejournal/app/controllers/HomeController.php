<?php

class HomeController extends BaseController {
	// create view for home
	public function home() {	
		return View::make('home');
	}
	// Post for home page - answers form
	public function postHome() {
		$v = Validator::make(Input::all(), array(
				'answer' => 'required'
			)
		);
		if ($v->fails()) {
			return Redirect::route('home')
				->withErrors($v)
				->withInput();
		} else {
			if(Auth::user()->birthday == date('Y-m-d')) {
				// on a users birthday ----------------------------------
				$answer = Answer::create(array(
						'answer'		=> Input::get('answer'),
						'year'			=> date("Y"),
						'user_id'		=> Auth::user()->id,
						'question_id'	=> '999'
					)
				);
				if($answer) {
					return Redirect::route('home')->with('global', 'your answer has been saved');
				} else {
					return Redirect::route('home')->with('global', 'your answer has NOT been saved');
				}
			} else {
				// on a regular day ---------------------------------
				$answer = Answer::create(array(
						'answer'		=> Input::get('answer'),
						'year'			=> date("Y"),
						'user_id'		=> Auth::user()->id,
						'question_id'	=> date("z")
					)
				);
				if($answer) {
					return Redirect::route('home')->with('global', 'your answer has been saved');
				} else {
					return Redirect::route('home')->with('global', 'your answer has NOT been saved');
				}
			}
		}
	}

	public function getLogout() {
		Auth::logout(); 
		return Redirect::route('home'); 
	}

	public function getWebHome() {
		return View::make('webhome');
	}
}
