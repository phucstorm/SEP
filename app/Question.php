<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
