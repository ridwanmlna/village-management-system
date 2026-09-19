<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'nik',
        'name',
        'tempat_tanggal_lahir',
        'tanggal_lahir',  // <<< pastikan ini ada
        'agama',
        'pekerjaan',
        'jenis_kelamin',
        'alamat',
        'status_perkawinan',   // <<< ditambahkan
        'warga_negara',        // <<< ditambahkan
        'password',
        'user_type'
    ];

    const USER_TYPE_ADMIN = 1;
    const USER_TYPE_USER = 2;
}
