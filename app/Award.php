<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    //この受賞に紐付けされた芸人
    Public function entertainer()
    {
        // Profileモデルのデータを引っ張てくる
        return $this->belongsTo(Entertainer::class);
    }
}
