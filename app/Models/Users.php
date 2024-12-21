<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; 
    protected $primaryKey = 'id_user'; 

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_user', 'id_user');
    }
}
