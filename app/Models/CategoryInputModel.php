<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryInputModel extends Model
{
    use HasFactory;

    protected $table = 'tb_kategori_pemasukan';

    protected $fillable = [
        'kategori_pemasukan_id',
        'nama_pemasukan',
        'deskripsi_kategori_pemasukan',
        'icon_pemasukan'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
