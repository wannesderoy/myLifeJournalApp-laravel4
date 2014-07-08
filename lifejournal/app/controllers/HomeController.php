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
			$y = date("Y");
			$z = date("z");
			$answer = Answer::create(array(
					'answer'		=> Input::get('answer'),
					'year'			=> $y,
					'user_id'		=> Auth::user()->id,
					'question_id'	=> $z
				)
			);
			if($answer) {
				return Redirect::route('home')->with('global', 'your answer has been saved');
			} else {
				return Redirect::route('home')->with('global', 'your answer has NOT been saved');
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
