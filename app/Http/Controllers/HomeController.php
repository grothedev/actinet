<?php

namespace App\Http\Controllers;

use Request;
use App\Post;
use App\User;
use App\Tag;

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

        $query = Request::all(); //CURRENTLY WORKING ON THIS
        $posts = null;

        $postsArray = Array();

        if (sizeof($query) == 0){
            $posts = Post::all();
        } else {


            //$tagsStr = explode(' ', $query['tags']);
            //$tagsStr = Input::get('tags');
            var_dump($query);

            foreach ($tagsStr as $t){
                $tag = Tag::where('tag', $t )->first();
                
                if (is_null($posts)){
                    $posts = $tag->posts;
                } else {
                    $posts->union($tag->posts()->get());
                    echo $tag->posts;                   
                }
            }

               /* 
            foreach($posts as $post){

                $noMatch = true;

                foreach ($tags as $tag){
                    //echo $post->tags()->get() . '<br>';



                    foreach ($post->tags()->get() as $pTag){
                        echo $pTag . '<br>';
                        if (strcmp($tag , $pTag['tag']) == 0){
                            echo 't';
                            $noMatch = false;
                            continue 2;
                        }
                    }
                }
                if ($noMatch){
                    echo $posts->pull($post->id);
                }
                
                //s$posts->remove($post);
                /*if(){
                    if ($tag = Tag::where('tag', $tString)->first()){
                       array_push($postsArray, $tag->posts->toArray());
                    }
                }
            }*/


        }
        //testing with single user
        //$user = User::where('name', $query['users'])->first();

         //figure out default query here
        
        //return var_dump($posts);

       // $posts = new Collection($postsArray);

        $tags = Tag::all()->pluck('tag');

        return view('home', compact('posts', 'tags'));
        
    }
}
