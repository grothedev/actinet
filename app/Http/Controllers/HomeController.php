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
            

            //tagIds from the tag select dropdown
            if (array_key_exists('tagIds', $query)){

                foreach($query['tagIds'] as $tId){
                    $tag = Tag::where('id', $tId)->first();
                    if ($tag){ //tag should exist, because only existing tags are possible to input
                        if (is_null($posts)){
                            $posts = $tag->posts;
                        } else {
                            foreach($tag->posts as $p){
                                if (!$posts->contains($p)){ //dealing with duplicates
                                    $posts->prepend($p);    
                                }
                                
                            }
                        }
                    }
                }
            }



            /*
            if (array_key_exists('tags', $query)){
                $tagsStr = explode(' ', $query['tags']);

                foreach ($tagsStr as $t){
                    $tag = Tag::where('tag', $t )->first();
                    if ($tag){
                        if (is_null($posts)){
                            $posts = $tag->posts;
                        } else {
                            echo 'b';

                            foreach($tag->posts as $p){
                                $posts->union($p);
                            }

                            //$posts->union($tag->posts->toArray());
                            //var_dump( $tag->posts);
                            echo $tag->posts;                   
                        }
                    }

                    
                }
                echo '<pre>';
                print_r($posts);
                echo '</pre>';
            }*/
        
            if (array_key_exists('users', $query)){
                $usersStr = explode(' ', $query['users']);

                foreach ($usersStr as $u){
                    $user = User::where('name', $u)->first();
                    if ($user){
                        if (is_null($posts)){
                            $posts = $user->posts;
                        } else {
                            
                            foreach($user->posts as $p){
                                if (!$posts->contains($p)){ //dealing with duplicates
                                    $posts->prepend($p);    
                                }
                            }
                        }
                    }
                }

            }
        }
        
        //return var_dump($posts);

       // $posts = new Collection($postsArray);

        $tags = Tag::all();
        
        return view('home', compact('posts', 'tags'));
        
    }
}
