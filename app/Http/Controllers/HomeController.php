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
        /*
            if a query has been submitted, get the posts with the appropiate tags and users
            receives tags as a string with tags separated by spaces
        */

        $query = Request::all();
        $posts = null;
        $postsArray = Array();


        if (sizeof($query) == 0){ //query empty
            $posts = Post::all();
        } else {

            if (array_key_exists('all_tags', $query)){
                if ($query['all_tags'] = "1"){
                    $posts = Post::all();                   
                } 
            }
            
            if (array_key_exists('tags', $query)){
                $tagsStr = explode(' ', $query['tags']);

                foreach ($tagsStr as $t){
                    $tag = Tag::where('tag', $t )->first();
                    if ($tag){
                        if (is_null($posts)){
                            $posts = $tag->posts;
                        } else {
                            $posts->union($tag->posts()->get());
                            echo $tag->posts;                   
                        }
                    }

                    
                }
            }
        
            if (array_key_exists('users', $query)){
                $usersStr = explode(' ', $query['users']);

                foreach ($usersStr as $u){
                    $user = User::where('name', $u)->first();
                    if ($user){
                        if (is_null($posts)){
                            $posts = $user->posts;
                        } else {
                            $posts->union($user->posts()->get());
                        }
                    }
                }

            }

            /*foreach($posts as $post){

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
                
                $posts->remove($post);
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

        //$tagIds = Tag::all()->pluck('id')->toArray();
        //$tags = Tag::all()->pluck('tag')->toArray();
        
        return view('home', compact('posts'));
        
    }
}
