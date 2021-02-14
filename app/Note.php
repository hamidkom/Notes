<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
     protected $fillable = [
        'Title', 'Content', 'Observations', 'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User' );
    }
}
