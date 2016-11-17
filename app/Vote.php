<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['id', 'object_id', 'object_type', 'user_id', 'vote'];
}
