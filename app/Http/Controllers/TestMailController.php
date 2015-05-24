<?php namespace App\Http\Controllers;

use Mail;

class TestMailController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *s
	 * @return Response
	 */
	public function index()
	{
		echo "asdadse2";

	$content = "Hi,welcome user!";

	$data = [
    'content' => $content
	];

	Mail::send('emails.mail-template', $data, function($message) {

    $message->to('mansour.hachem@hotmail.com', 'Jon Doe');
    $message->subject('Welcome to the Laravel 4 Auth App!');
    $message->from('kjhkjh@k.com', 'lm lm');

});

	}

}
