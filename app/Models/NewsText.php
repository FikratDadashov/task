<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsText extends Model
{
    protected $table = 'news_text';
    public $timestamps = false;
    protected $fillable = [
        'text',
        'language_id',
        'news_id'
    ];


}
