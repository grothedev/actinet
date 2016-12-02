<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	/*
		sub type
			0: tag
			1: user
	*/
    protected $fillable = ['id', 'user_id', 'sub_type', 'sub_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
