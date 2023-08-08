<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    protected $table = 'function';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'module_id'
    ];

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
