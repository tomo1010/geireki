<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfomer extends Model
{
    //この個人が所属するコンビ名。
    public function entertainer()
    {
        return $this->belongsTo(Entertainer::class);
    }
}
