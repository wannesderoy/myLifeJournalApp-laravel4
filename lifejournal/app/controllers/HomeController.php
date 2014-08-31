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
					->withInput();
			} else {
				// if it's the users birthday
				if(User::UserBirthdate() == date('m-d')) {
					////////////////////////////////////// On a users birthday ----------------------------------
					if (Input::hasFile('answer_image')) {
						$size = Input::file('answer_image')->getSize();
						if($size < 50000000) {
							// The same for both images
							$today = date("z");
							$file = Input::file('answer_image');
							$extension = $file->getClientOriginalExtension();
							$username = User::SlugName();
							$rand_file = Str::lower(Str::random(20, 'numeric'));
						
							///////////////////// Large image ----------------------------------
							$filename_l = $rand_file.'_large';
							$filenameAndExtension_l = $filename_l . "." . $extension;
							$path_l = "answer_images/".$username."/".$today."/";
							$fullFile_l = $path_l. $filenameAndExtension_l;
							
							// move large(original) file to location
							$fileMove_l = $file->move($path_l, $filenameAndExtension_l);
							
							///////////////////// Small image ----------------------------------
							$filename_s = $rand_file.'_small';
							$filenameAndExtension_s = $filename_s . "." . $extension;
							$path_s = "answer_images/".$username."/".$today."/";
							$fullFile_s = $path_s . $filenameAndExtension_s;

							// Copy image large image
							File::copy($fullFile_l,$fullFile_s);
							
							// Crop image to 200px height
							$image_s = new SimpleImage();
							$image_s->load($fullFile_s);
							$image_s->resizeToHeight(200);
							$image_s->save($fullFile_s);
							
							// Input in db
							$answer = Answer::create(array(
									'answer'		=> Input::get('answer'),
									'year'			=> date("Y"),
									'user_id'		=> Auth::user()->id,
									'question_id'	=> '999',
									'image_s'		=> $fullFile_s,
									'image_l'		=> $fullFile_l,
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
						$size = Input::file('answer_image')->getSize();
						if($size < 50000000) {
							// The same for both images
							$today = date("z");
							$file = Input::file('answer_image');
							$extension = $file->getClientOriginalExtension();
							$username = User::SlugName();
							$rand_file = Str::lower(Str::random(20, 'numeric'));
						
							///////////////////// Large image ----------------------------------
							$filename_l = $rand_file.'_large';
							$filenameAndExtension_l = $filename_l . "." . $extension;
							$path_l = "answer_images/".$username."/".$today."/";
							$fullFile_l = $path_l. $filenameAndExtension_l;
							
							// move large(original) file to location
							$fileMove_l = $file->move($path_l, $filenameAndExtension_l);
							
							///////////////////// Small image ----------------------------------
							$filename_s = $rand_file.'_small';
							$filenameAndExtension_s = $filename_s . "." . $extension;
							$path_s = "answer_images/".$username."/".$today."/";
							$fullFile_s = $path_s . $filenameAndExtension_s;

							// Copy image large image
							File::copy($fullFile_l,$fullFile_s);
							
							// Crop image to 200px height
							$image_s = new SimpleImage();
							$image_s->load($fullFile_s);
							$image_s->resizeToHeight(200);
							$image_s->save($fullFile_s);
							
							// Input in db
							$answer = Answer::create(array(
									'answer'		=> Input::get('answer'),
									'year'			=> date("Y"),
									'user_id'		=> Auth::user()->id,
									'question_id'	=> date("z")+1,
									'image_s'		=> $fullFile_s,
									'image_l'		=> $fullFile_l,
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
		$answer = Answer::image($image_name);
		$question = Question::dynamicDayQuestion($day);
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