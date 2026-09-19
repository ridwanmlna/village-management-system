<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'user_id',
        'prefix_surat',
        'nomor_surat_angka',
        'nomor_surat',
        'cetak_at',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
