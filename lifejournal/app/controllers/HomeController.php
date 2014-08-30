<?php

class HomeController extends BaseController {
	// create view for home
	public function home() {	
		return View::make('home');
	}
	// Post for home page - answers form
	public function postHome() {

		$v = Validator::make(Input::all(), array(
				'answer' 		=> 'required',
			)
		);
		if ($v->fails()) {
			return Redirect::route('home')
				->with('global', 'all fields are required.')
				->withErrors($v)
				->withInput();
		} else {
			if(Auth::user()->birthday == date('Y-m-d')) {
				////////////////////////////////////// On a users birthday ----------------------------------
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
				////////////////////////////////////// On a regular day ---------------------------------
				// image handler
				if (Input::hasFile('answer_image')) {
					$size = Input::file('answer_image')->getSize();
					if($size < 50000000) {
						$extension = Input::file('answer_image')->getClientOriginalExtension();
						$path = "answer_images/" . User::SlugName()."/";
						$filename = Str::lower(Str::random(20, 'numeric'));		
						$filenameAndExtension = $filename . "." . $extension;	
						$fullFile = $path . $filenameAndExtension;
						$fileMove = Input::file('answer_image')->move($path, $filenameAndExtension);
						// $u->profile_pic = $fullFile;

						// create input in db
						$answer = Answer::create(array(
								'answer'		=> Input::get('answer'),
								'year'			=> date("Y"),
								'user_id'		=> Auth::user()->id,
								'question_id'	=> date("z")+1,
								'image'			=> $fullFile
							)
						);
						if($answer) {
							// if answer is saved succesfully in db, redirect to home with succes message
							return Redirect::route('home')->with('global', 'your answer has been saved');
						} else {
							// if  answer is saved UNsuccesfully in db, redirect to home with error message
							return Redirect::route('home')->with('global', 'your answer has NOT been saved');
						}

					} else {
						return Redirect::route('home')->with('global', 'Picture size is to large.');
					}
				} else {
					// create input in db
					$answer = Answer::create(array(
							'answer'		=> Input::get('answer'),
							'year'			=> date("Y"),
							'user_id'		=> Auth::user()->id,
							'question_id'	=> date("z")+1,
							'image'			=> $fullFile
						)
					);
					if($answer) {
						// if answer is saved succesfully in db, redirect to home with succes message
						return Redirect::route('home')->with('global', 'your answer has been saved');
					} else {
						// if  answer is saved UNsuccesfully in db, redirect to home with error message
						return Redirect::route('home')->with('global', 'your answer has NOT been saved');
					}
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
	public function getCal() {
		return View::make('calendar');
	}
}
