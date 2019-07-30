<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll_Question extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function answers()
    {
        return $this->hasMany(Poll_Answer::class);
    }
}
