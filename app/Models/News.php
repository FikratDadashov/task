<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'status_id',
        'view_count'
    ];

    public function text(){
        return $this->hasMany(NewsText::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

}
