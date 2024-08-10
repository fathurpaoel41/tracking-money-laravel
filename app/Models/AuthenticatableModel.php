<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as AuthenticatableModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Sanctum\HasApiTokens;


class AuthenticatableModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'email',
        'verification_email',
        'password',
        'name',
        'gambar_user',
        'ttl',
        'alamat',
        'no_telp',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}