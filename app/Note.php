<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
     protected $fillable = [
        'Title', 'Content', 'Observation',
    ];
}