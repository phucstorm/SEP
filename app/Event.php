<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('created_at', 'DESC');
    }

    public function polls()
    {
        return $this->hasMany(Poll_Question::class)->orderBy('created_at', 'DESC');
    }
}
