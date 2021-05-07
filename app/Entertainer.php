<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; // 追加

class Entertainer extends Model
{
    use Sortable; // 追加
    public $sortable = ['name', 'active']; // 追加
}
