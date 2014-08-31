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
						// the same for both images
						$extension = Input::file('answer_image')->getClientOriginalExtension();
						$filename = Str::lower(Str::random(20, 'numeric'));
						$filenameAndExtension = $filename . "." . $extension;

						///////////////////// Large image ----------------------------------
						$path_l = "answer_images/" . User::SlugName()."_large/";
						$fullFile_l = $path_l. $filenameAndExtension;
						$fileMove_l = Input::file('answer_image')->move($path_l, $filenameAndExtension);

						$image_l = new SimpleImage();
						$image_l->load($fullFile_l);
						$image_l->resizeToHeight(200);
						$image_l->save($fullFile_l);


						///////////////////// Small image ----------------------------------
						$path_s = "answer_images/" . User::SlugName()."_small/";
						$fullFile_s = $path_s . $filenameAndExtension;
						$fileMove_s = Input::file('answer_image')->move($path_s, $filenameAndExtension);

						$image_s = new SimpleImage();
						$image_s->load($fullFile_s);
						$image_s->resizeToHeight(200);
						$image_s->save($fullFile_s);

						
						// create input in db
						$answer = Answer::create(array(
								'answer'		=> Input::get('answer'),
								'year'			=> date("Y"),
								'user_id'		=> Auth::user()->id,
								'question_id'	=> date("z")+1,
								'image_s'		=> $fullFile_s,
								'image_l'		=> $fullFile_l
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
						// if picture size is to large
						return Redirect::route('home')->with('global', 'Picture size is to large.');
					}
				} else {
					// if no image is included create input in db
					$answer = Answer::create(array(
							'answer'		=> Input::get('answer'),
							'year'			=> date("Y"),
							'user_id'		=> Auth::user()->id,
							'question_id'	=> date("z")+1,
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
