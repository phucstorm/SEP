<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll_Answer extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll_Question::class);
    }
}
