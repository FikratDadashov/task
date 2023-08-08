<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'fullname'
    ];

    public function groups() {
        return $this->belongsToMany(Group::class, 'group_users');
    }

    public function functions()
    {
        return $this->belongsToMany(Functions::class,'user_function','user_id','function_id');
    }

}
