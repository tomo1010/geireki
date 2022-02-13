<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; // 追加

class Perfomer extends Model
{
    
    use Sortable; // 追加
    public $sortable = ['name', 'active']; // 追加
    
    
    //この個人が所属するコンビ名。
    public function entertainer()
    {
        return $this->belongsToMany(Entertainer::class, 'members', 'perfomer_id', 'entertainer_id');
        //return $this->belongsToMany(Entertainer::class);
        //return $this->belongsTo(Entertainer::class);
    }
    
    //この個人が所属する事務所。
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    
    //carbonで使えるように設定
    protected $dates   = ['birthday','deth','active','activeend'];
}
