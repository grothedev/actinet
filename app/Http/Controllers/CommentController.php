<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\Comment;
use App\Post;

class CommentController extends Controller{

	protected function validator(array $data){
		return Validator::make($data, [
            'text' => 'required|max:8192'
        ]);
	}

	public function store($commentable_data, Request $input){
		if (Auth::guest()){
			return 'must be logged in';
		} else {
			$input = Request::all();
			
			$input['user_id'] = Auth::user()['id'];

			//commentable is the post or comment which is being commented on
			$commentable_id = substr($commentable_data,  1);
			$commentable;
			$c;

			if (strpos($commentable_data, 'p') !== false){
				$commentable = Post::find($commentable_id);
				$input['post_id'] = $commentable_id;
				$input['parent_id'] = 0;

			} else {
				$commentable = Comment::find($commentable_id);
				$input['post_id'] = $commentable->post_id;
				$input['parent_id'] = $commentable_id;
			}
			$c = new Comment($input);
			$c->save();

			return redirect('/' . $c->post_id);
		}
		
		

		//old shit from before baum
		/*
		$commentable_id = substr($commentable_data,  1);

		$commentable;
		$comment;

 
		if (strpos($commentable_data, 'p') == 0){
			$commentable = Post::find($commentable_id);
			$comment = new Comment( ['text' => $input['text'], 'commentable_type' =>  'post',  'commentable_id' => $commentable_id ] );
		} else {
			$commentable = Comment::find($commentable_id);
			$comment = new Comment( ['text' => $input['text'], 'commentable_type' =>  'comment',  'commentable_id' => $commentable_id ] );
		}



		$commentable->comments()->save($comment);


		$post = $commentable;
		//return view('posts.show', compact('post')); //TODO showing comments
		//return redirect('/' . $commentable_id, compact('post'));
		*/
	}
}