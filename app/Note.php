<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
     protected $fillable = [
        'Title', 'Content', 'Observations', 'user_id','slug',
    ];
    public function notes()
{
    return $this->hasMany(Note::class);
}
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
        $notes = auth()->user()->notes();


    }
}
