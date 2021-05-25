<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; // 追加

class Entertainer extends Model
{
    use Sortable; // 追加
    public $sortable = ['name', 'active']; // 追加
    
    
    // dates（formatメソッドを使用できるようにする）
    protected $dates = [
        'created_at',
        'updated_at',
        'active', //　追加する
        'activeend' //　追加する
    ];
}
