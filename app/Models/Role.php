<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'role_id');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public static function countRoles()
    {
        return self::count();
    }
}
