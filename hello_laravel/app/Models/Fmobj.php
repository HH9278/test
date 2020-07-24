<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fmobj extends Model
{
    // テーブル名
    protected $table = 'fmobjs';

    // 可変項目
    protected $fillable =
    {
        'title',
        'content'
    };
}
