<?php
// migration route
Route::get('app/dbmigrate', 'DbmigrateController@index');

// website route
Route::get('/', array(
	'as' 	=> 'web-home',
	'uses' 	=> 'HomeController@getWebHome'
));

// home route
Route::get('/app/', array(
	'as' 	=> 'home',
	'uses' 	=> 'HomeController@home'
));

Route::post('/', array(
	'as' 	=> 'home-post',
	'uses' 	=> 'HomeController@postHome'
));
/*
//-- autheticated group --\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/

// account logout
Route::get('app/logout', array(
	'as' 	=> 'logout',
	'uses' 	=> 'HomeController@getLogout'
));

// settings route maker
Route::get('app/settings', array(
		'as' 	=> 'settings',
		'uses' 	=> 'settingsController@getSettings'
));
// calendar route maker
Route::get('app/calendar', array(
		'as' 	=> 'calendar',
		'uses' 	=> 'HomeController@getCal'
));	
// Answer picture route
Route::get('app/answer/{image_name}/{day}', array(
	'as'	=>'answer-image',
	'uses'	=>'HomeController@answerImage'
));
/*
// CSRF protection group nested in the guest group \\\\\\\\\\\\\\\\
*/
Route::group(array('before' => 'csrf'), function() {
	// settins post
	Route::post('app/settings', array(
		'as' 	=> 'settings-post',
		'uses' 	=> 'settingsController@postSettings'
));
	
}); // End of CSRF protection

/*
//-- unautheticated group --\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
Route::group(array('before' => 'guest'), function() {

	/*
	// CSRF protection group nested in the guest group \\\\\\\\\\\\\\\\
	*/
	Route::group(array('before' => 'csrf'), function() {
		
		// login post
		Route::post('app/login', array(
			'as' 	=> 'start-login',
			'uses' 	=> 'accountController@postLogin'
		));
		//register post
		Route::post('app/register', array(
			'as' 	=> 'start-register',
			'uses' 	=> 'accountController@postRegister'
		));
	}); // End of CSRF protection

	/*
	// LOGIN \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	*/

	// login get
	Route::get('app/login', array(
		'as' 	=> 'start-login',
		'uses' 	=> 'accountController@getLogin'
	));

	//register get
	Route::get('app/register', array(
		'as' 	=> 'start-register',
		'uses' 	=> 'accountController@getRegister'
	));

	/*
	// LEGAL \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	*/

	// privacy get
	Route::get('app/terms-o-use', array(
		'as' 	=> 'legal-terms-o-use',
		'uses' 	=> 'accountController@getTerms'
	));

	// terms-o-use get
	Route::get('app/privacy', array(
		'as' 	=> 'legal-privacy',
		'uses' 	=> 'accountController@getPrivacy'
	));
});
