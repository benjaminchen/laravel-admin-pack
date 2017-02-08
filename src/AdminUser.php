<?php

namespace BenjaminChen\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    // role
    const ADMINISTRATOR = 1;
    const MANAGER = 2;
    const EDITOR = 3;

    protected $fillable = [
        'username', 'name', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return [
            'Administrator' => ADMINISTRATOR,
            'Manager' => MANAGER,
            'Editor' => EDITOR,
        ];
    }
}