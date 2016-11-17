<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'title', 'text', 'user_id', 'lat', 'lon'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function votes(){//do i need to have the inverse relationship on votes?
        return $this->hasMany('App\Vote');
    }

}
