<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Auth, Request;

class UserEditController extends Controller{
	public function edit(){ //update user info in db
		if ($user = Auth::user()){
			$data = Request::all();
			
			if ($data['profile_name'] != ""){
				$user->profile_name = $data['profile_name'];
			}
			if ($data['email'] != ""){
				$user->email = $data['email'];
			}
			if ($data['bio'] != ""){
				$user->bio = $data['bio'];
			}
			if ($data['password_new'] != ""){
				if ($data['password_new'] == $data['password_confirm_new']){
					$user->password = bcrypt($data['password_new']);
				}
			}
			$user->save();

			return redirect('/u/' . $user->id);

		} else {
			echo 'not logged in';
			return redirect('/login');
		}
	} 
}