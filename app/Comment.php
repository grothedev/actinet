<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
	use NodeTrait;

	protected $fillable = ['text', 'commentable_id', 'commentable_type', 'user_id', 'post_id', 'parent_id'];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function post(){
		return $this->belongsTo('App\Post');
	}

	public function commentable(){
		return $this->morphTo();
	}

	public function comments(){
    	return $this->morphMany('App\Comment', 'commentable');
    }

	/*function tags(){

	}*/

}
