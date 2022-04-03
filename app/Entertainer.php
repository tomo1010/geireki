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
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     'active', //　追加する
    //     'activeend' //　追加する
    // ];
    

    
    //この芸人が所属する事務所。
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    
 
    //このコンビに所属するメンバー（個人）
    public function perfomers()
    {
        return $this->belongsToMany(Perfomer::class, 'members', 'entertainer_id', 'perfomer_id');
        //return $this->belongsToMany(Perfomer::class);
        //return $this->hasMany(Perfomer::class);
    }
    
    
    
    //この芸人に紐付けされたYoutubeのURL
    public function youtubes()
    {
        return $this->hasMany(Youtube::class);
    }

    
    
    //この芸人に紐付けされた受賞歴
    Public function award()
    {
        // Profileモデルのデータを引っ張てくる
        return $this->hasMany(Award::class);
    }
    
    
    
}
