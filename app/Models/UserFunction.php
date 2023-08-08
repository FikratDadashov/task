<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFunction extends Model
{
    protected $table = 'user_function';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'function_id'
    ];

}
