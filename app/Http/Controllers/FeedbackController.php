<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function index(){
    	return view('feedback_form');
    }

    public function create(){
    	$data = Request::all();

    	//dealing directly with db cause i figured it was unnecessary to make a model for feedback
    	if (DB::insert('insert into feedback (text, email) values (?, ?)', [$data['text'], $data['email']])){
    		echo 'success';
    		return redirect('/');
    	} else {
    		echo 'failed';
    	}


    }
}
