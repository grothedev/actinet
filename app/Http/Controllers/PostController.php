<?php

namespace App\Http\Controllers;


use App\Post;
use Request;
use Auth;
use App\Tag;
use QueryException;

class PostController extends Controller{
	public function index(){
		return view('posts.create');
	}	

	public function store(){

		if (Auth::guest()){
			return 'must be logged in';
		} else {
			$input = Request::all();
			$user = Auth::user();
			$input['user_id'] = $user['id'];

			$post = Post::create($input);


			$tags = explode(' ', $input['tags']);

			foreach($tags as $tag){
				
				$t = Tag::firstOrCreate(['tag' => $tag]);
					
				$post->tags()->attach($t['id']);
			}

			
			
			return view('posts.show', compact('post'));
		}
	}

	public function show($id){
		$post = Post::findOrFail($id);

		$comments = $post->comments()->get();
		//$commentTree = $comments->getDescendantsAndSelf()->toHierarchy();
		//var_dump($commentTree);
		return view('posts.show', compact('post', 'comments'));
	}
}