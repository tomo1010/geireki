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
    
    
    protected $fillable = [
        'youtube', 'time', 'entertainer_id',
    ];
    
    
    
    /**
    * このyoutube動画をお気に入りにしたユーザ。
    */
    public function favoritesUser()
    {
        return $this->belongsToMany(User::class, 'favorites', 'youtube_id', 'user_id')->withTimestamps();
    }
    
    
    
    /**
     * このyoutub動画のお気に入り件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('users');
    }
    
    
    
}
