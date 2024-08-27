<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'id_user';
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'name',
        'email',
        'password',
        'ttl',
        'alamat',
        'no_telp',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'ttl' => 'date'
        ];
    }
}
