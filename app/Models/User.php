<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'last_login'
    ];

    protected $hidden = [
        'password'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public static function countUsers()
    {
        return self::withTrashed()->count();
    }
}
