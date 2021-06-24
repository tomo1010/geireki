<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{

    //Userモデルとの関係を定義）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //Entertainerモデルとの関係を定義
    public function entertainer()
    {
        return $this->belongsTo(Entertainer::class);
    }
}
