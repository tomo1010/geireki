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
    
    //この個人が所属する事務所。
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    
    //carbonで使えるように設定
    protected $dates   = ['birthday','active'];
}
