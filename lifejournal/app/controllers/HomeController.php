<?php

class HomeController extends BaseController {
	// create view for home
	public function home() {	
		return View::make('home');
	}
	// Post for home page - answers form
	public function postHome() {
		if ( Session::token() != Input::get( '_token' ) ) {
			return Redirect::route('home')->with('global', 'There was a token mismatch, please try again.');		
        } else {
			$v = Validator::make(Input::all(), array(
					'answer' 		=> 'required',
					'answer_image'	=> 'image'
				)
			);
			if ($v->fails()) {
				return Redirect::route('home')
					->withErrors($v)
					->withInput()
					->with('global', "There was a problem with the input, please try again.");
			} else {
				// if it's the users birthday
				if(User::UserBirthdate() == date('m-d')) {
					////////////////////////////////////// On a users birthday ----------------------------------
					if (Input::hasFile('answer_image')) {
						$file = Input::file('answer_image');
						$size = $file->getSize();
						if($file->isValid()) {
							if($size < 50000000) {
								// Generate random name for 2 images
								$file_name_rand 	= Str::lower(Str::random(20, 'numeric'));

								// init the ImageHandler class and call image_ functions with right params
								$large_image_name = ImageHandler::answer_image_large($file,$file_name_rand);
								$small_image_name = ImageHandler::answer_image_small($file,$file_name_rand);

								// Input in db
								$answer = Answer::create(array(
										'answer'		=> Input::get('answer'),
										'year'			=> date("Y"),
										'user_id'		=> Auth::user()->id,
										'question_id'	=> '999',
										'image_s'		=> $small_image_name,
										'image_l'		=> $large_image_name,
										'image_name'	=> $rand_file
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
							// if image is not a valid image by isValid()
							return Redirect::rout('global', 'Your image is not a valid image.');
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
				} else {
					////////////////////////////////////// On a regular day ---------------------------------
					if (Input::hasFile('answer_image')) {
						$file = Input::file('answer_image');
						$size = $file->getSize();
						if($file->isValid()) {
							if($size < 50000000) {
								// Generate random name for 2 images
								$file_name_rand 	= Str::lower(Str::random(20, 'numeric'));

								// init the ImageHandler class and call image_ functions with right params
								$large_image_name = ImageHandler::answer_image_large($file,$file_name_rand);
								$small_image_name = ImageHandler::answer_image_small($file,$file_name_rand);

								// Input in db
								$answer = Answer::create(array(
										'answer'		=> Input::get('answer'),
										'year'			=> date("Y"),
										'user_id'		=> Auth::user()->id,
										'question_id'	=> date("z")+1,
										'image_s'		=> $small_image_name,
										'image_l'		=> $large_image_name,
										'image_name'	=> $file_name_rand
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
							// if image is not a valid image by isValid()
							return Redirect::rout('global', 'Your image is not a valid image.');
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
	}
	public function answerImage($image_name, $day) {
		$answer 	= Answer::image($image_name);
		$question 	= Question::dynamicDayQuestion($day);
		return View::make('answerPicture')->with('answer', $answer)->with('question', $question);
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