<?php

namespace App\Http\Controllers;


use App\Post;
use Request;
use Auth;
use App\Tag;
use App\Vote;

use QueryException;

class PostController extends Controller{
	public function index(){
		$tags = Tag::all(); //send all tags to post making form for suggestions
		return view('posts.create', compact('tags'));
	}	

	protected function validator(array $data){
		return Validator::make($data, [
            'title' => 'required|max:255',
            'text' => 'required|max:8192'
        ]);
	}

	public function store(){

		if (Auth::guest()){
			return 'must be logged in';
		} else {
			$input = Request::all();
			$user = Auth::user();
			$input['user_id'] = $user['id'];
			$input['lat'] = 42.030781;
			$input['lon'] = -93.631913;
			$input['score'] = 0; //this should be dealth with in migration

			$post = $user->posts()->create($input);



			//$tags = explode(' ', $input['tags']); //this is from the old way

			$tags = $input['tags'];

			foreach($tags as $tag){
				
				$t = Tag::firstOrCreate(['tag' => $tag]);
					
				$post->tags()->attach($t['id']);
			}

			
			$comments = Array(); //need to pass in null comments for the show view
			return redirect('/' . $post->id); //redirecting to prevent duplicate form submission
			//return view('posts.show', compact('post', 'comments'));
		}
	}

	public function show($id){
		$post = Post::findOrFail($id);

		//retrieve first level comments so traverse function doesn't give duplicates
		$comments = $post->comments()->withDepth()->having('depth', '=', 0)->get();

		//$commentTree = $comments->getDescendantsAndSelf()->toHierarchy();
		//var_dump($commentTree);
		return view('posts.show', compact('post', 'comments'));
	}

	public function vote(){
		$input = Request::all();
		$pId = $input['pId'];
		$v = $input['value']; //upvote or downvote, 1 or 0
		$uId = Auth::user()['id'];

		//checking if the user has already voted
		$vote = Vote::where('user_id', $uId)->where('object_id', $pId)->get();
		if (sizeof($vote) !== 0){ 
			return 'already voted';
		} else {
			
			if ($v == 0){ //downvote
				Post::find($pId)->decrement('score');
			} else { //upvote
				Post::find($pId)->increment('score');
			}

			Vote::create(['object_id' => $input['pId'], 'object_type' => 'post', 'user_id' => 1, 'vote' => $input['value']]);
			
			return 'vote complete';
		}

		

		

	}
}