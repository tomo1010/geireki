<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    //この事務所に所属する芸人
    public function entertainers()
    {
        return $this->hasMany(Entertainer::class);
    }
}
