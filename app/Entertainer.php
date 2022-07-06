<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; // 追加

class Entertainer extends Model
{
    
    protected $fillable = [
        'id', 'office_id', 'name', 'numberofpeople','gender','birthday','alias', 'active','activeend' ,'master' ,'oldname' ,'brain' ,'encounter' ,'named' ,'memo' ,'official' ,'twitter' ,'youtube' ,'tiktok',
    ];
    
    use Sortable; // 追加
    public $sortable = ['name', 'active']; // 追加
    
    
    //dates（formatメソッドを使用できるようにする）
    protected $dates = [
        'created_at',
        'updated_at',
        'active', //　追加する
        'activeend' //　追加する
    ];
    

    
    //この芸人が所属する事務所。
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    
 
    //このコンビに所属するメンバー（個人）
    public function perfomers()
    {
        return $this->belongsToMany(Perfomer::class, 'members', 'entertainer_id', 'perfomer_id');
    }
    
    
    
    //この芸人に紐付けされたYoutubeのURL
    public function youtubes()
    {
        return $this->hasMany(Youtube::class);
    }

    
    
    //この芸人に紐付けされた受賞歴
    Public function award()
    {
        // モデルのデータを引っ張てくる
        return $this->hasMany(Award::class);
    }



    //この芸人に紐付けされたTag
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'entertainer_tag', 'entertainer_id', 'tag_id')->withTimestamps();
    }
    

    //この芸人に紐付けされたユーザ
    public function users()
    {
        return $this->belongsToMany(User::class, 'entertainer_tag', 'entertainer_id', 'user_id')->withTimestamps();
    }


    /**
    * $tag_idで指定されたtagを登録する。
    *
    * @param int $tagId
    * @return bool
    */
    public function tagging($tagId)
    {
        // すでにtagしているかの確認
        $exist = $this->is_tagging($tagId);
        
        // // 自分の投稿かどうかの確認
        // $its_me = $this->favoritesYoutubes()->youtube_id == $youtubeId;
        
        if ($exist) {
            
            // すでにtag済みなら何もしない
            return false;
        
        } else {
        
        
        // tag登録をする
            $this->tags()->sync($tagId);
            return true;
        }
     
    }
     
     
     
    /**
    * $youtube_idで指定されたYouutbe動画をのお気に入り登録を外す。
    *
    * @param int $youtubeId
    * @return bool
    */
    public function untagging($tagId)
    {
        // すでにお気に入りしているかの確認
        $exist = $this->is_tagging($tagId);
        
        // // 相手が自分自身かどうかの確認
        // $its_me = $this->id == $youtubeId;
        if ($exist) {
            
        // すでにフォローしていればフォローを外す
        $this->tags()->detach($tagId);
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
    public function is_tagging($tagId)
    {
        // すでにtag登録の中に $tagIdが存在するか
        return $this->tags()->where('tag_id', $tagId)->exists();
    }

    
    
}
