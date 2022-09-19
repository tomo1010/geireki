<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    //このTagに紐付けされた芸人
    public function entertainers()
    {
        return $this->belongsToMany(Entertainer::class, 'entertainer_tag', 'tag_id', 'entertainer_id')->withTimestamps();
    }


    // //このTagに紐付けされた芸人
    // public function entertainer()
    // {
    //     return $this->hasOne(Entertainer::class);
    // }


    //このTagに紐付けされたユーザー
    public function users()
    {
        return $this->belongsToMany(User::class, 'entertainer_tag', 'tag_id', 'user_id')->withTimestamps();
    }    
    
    
}
