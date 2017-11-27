<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = ['sender_id','receiver_id','quantity','status'];
    
    public function user()
    {
        return $this->belongsToMany('User');
    }
}
