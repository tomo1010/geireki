<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin_flag','birthday','birthplace',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    //このユーザーが投稿したYoutubeURL
    public function youtubes()
    {
        return $this->hasMany(Youtube::class);
    }

    
    //投稿したURLの件数をロード
    public function loadRelationshipCounts()
    {
        $this->loadCount('youtubes');
    }
    
    
    
    
    
    /**
    * このユーザがお気に入りにしているYoutube。
    */
    public function favoritesYoutubes()
    {
        return $this->belongsToMany(Youtube::class, 'favorites', 'user_id', 'youtube_id')->withTimestamps();
    }
  
     

     
     
    /**
    * $youtube_idで指定されたyoutube動画をお気に入り登録する。
    *
    * @param int $youtubeId
    * @return bool
    */
    public function favorite($youtubeId)
    {
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($youtubeId);
        
        // // 自分の投稿かどうかの確認
        // $its_me = $this->favoritesYoutubes()->youtube_id == $youtubeId;
        
        if ($exist) {
            
            // すでにお気に入り、もしくは自分の投稿なら何もしない
            return false;
        
        } else {
        
            // お気に入り登録をする
            $this->favoritesyoutubes()->attach($youtubeId);
            return true;
        }
     
    }
     
     
     
    /**
    * $youtube_idで指定されたYouutbe動画をのお気に入り登録を外す。
    *
    * @param int $youtubeId
    * @return bool
    */
    public function unfavorite($youtubeId)
    {
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($youtubeId);
        
        if ($exist) {
            
            // すでにフォローしていればフォローを外す
            $this->favoritesyoutubes()->detach($youtubeId);
            return true;
        
        } else {
        
        // 未フォローであれば何もしない
        return false;
        }
    }
     
     
     
    /**
    * 指定された $youtubeIdのyoutub動画をこのユーザがお気に入り中であるか調べる。お気に入りならtrueを返す。
    *
    * @param int $userId
    * @return bool
    */
    public function is_favorite($youtubeId)
    {
        // すでにお気に入りの中に $youtubeIdが存在するか
        return $this->favoritesYoutubes()->where('youtube_id', $youtubeId)->exists();
    }
    
    
    
    
    
    
    //このユーザに紐付けされたTag
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'entertainer_tag', 'user_id', 'tag_id')
                        ->withPivot('entertainer_id')
                        ->withTimestamps();
    }



    //このユーザにtagづけけされた芸人
    public function entertainers()
    {
        return $this->belongsToMany(Entertainer::class, 'entertainer_tag', 'user_id', 'entertainer_id')->withTimestamps();
    }    
    
    
    

    //Tagした件数をロード
    public function loadTagCounts()
    {
        $this->loadCount('tags');
    }




    /**
    * $tag_idで指定されたtagを登録する。
    *
    * @param int $tagId
    * @return bool
    */
    public function tagging($request)
    {

        // すでにタグ登録しているかの確認
        $exist = $this->is_tagging($request->tag_id,$request->entertainer_id);
        
        if ($exist) {
            
            // すでにタグ済みなら何もしない
            return false;
        
        } else {
        
            // 認証済みユーザが芸人のタグ登録する
            $this->entertainers()->attach($request->entertainer_id, ['tag_id' => $request->tag_id]);            
            return true;
        }
     
    }
     
     

    /**
    * $tag_idで指定されたtagり登録を外す。
    *
    * @param int $tagId
    * @return bool
    */
    public function untagging($request)
    {
        // すでにタグしているかの確認
        $exist = $this->is_tagging($request->tag_id,$request->entertainer_id);

        
        if ($exist) {
            
            // すでにタグ済みならタグを外す
            $this->entertainers()->wherePivot('tag_id', '=', $request->tag_id)->detach($request->entertainer_id);
            return true;
        
        } else {
            
            // 未フォローであれば何もしない
            return false;
        }
    }
     
     
     
    /**
    * 指定された $tagIdのtagをこの芸人がタグ登録済みであるか調べる。登録済みならtrueを返す。
    *
    * @param int $tagId
    * @return bool
    */
    public function is_tagging($tagId,$entertainerId)
    {
        // すでにタグ登録されてるかどうか
        return $this->entertainers()->where('entertainer_id', $entertainerId)->whereHas('tags',function($query) use($tagId) {
                        $query->where('tag_id', $tagId);
                    })->exists();
    }



    
}
