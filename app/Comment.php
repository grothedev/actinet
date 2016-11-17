<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Comment extends Node
{

	protected $table = 'comments';


    protected $fillable = ['text', 'user_id', 'post_id', 'parent_id'];


    public function user(){
		return $this->belongsTo('App\User');
	}

	public function post(){
		return $this->belongsTo('App\Post');
	}

	public function votes(){
        return $this->hasMany('App\Vote');
    }

	/*public function commentable(){
		return $this->morphTo();
	}

	public function comments(){
    	return $this->morphMany('App\Comment', 'commentable');
    }*/
}
