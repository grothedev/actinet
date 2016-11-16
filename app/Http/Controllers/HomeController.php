<?php

namespace App\Http\Controllers;

use Request;
use App\Post;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = Request::all();

        //testing with single user
        //$user = User::where('name', $query['users'])->first();

        $posts = Post::all(); //figure out default query here
        
        //return var_dump($posts);

        return view('home', compact('posts'));
    }
}
