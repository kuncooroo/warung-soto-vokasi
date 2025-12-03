<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['name', 'email', 'password', 'phone', 'role'];

    protected $hidden = ['password'];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }
}