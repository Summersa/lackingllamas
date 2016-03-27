<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
 
        'name',
        'description',
        'budget',
        'user_ID',
        'team'
    ];
}
