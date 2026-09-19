<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'isi_pengaduan',
        'status_pengaduan'
    ];

    const STATUS_MENUNGGU_TINJAUAN = 1;
    const STATUS_DITINJAU = 2;
    const STATUS_DITINDAKLANJUTI = 3;
    const STATUS_SELESAI = 4;
    const STATUS_DITOLAK = 5;

    public function getStatusAttribute()
    {
        $status = '';

        switch ($this->status_pengaduan) {

    case self::STATUS_MENUNGGU_TINJAUAN:
        $status = "<span class='badge badge-info'>Menunggu Tinjauan</span>";
        break;

    case self::STATUS_DITINJAU:
        $status = "<span class='badge badge-warning'>Ditinjau</span>";
        break;

    case self::STATUS_DITINDAKLANJUTI:
        $status = "<span class='badge badge-primary'>Ditindaklanjuti</span>";
        break;

    case self::STATUS_SELESAI:
        $status = "<span class='badge badge-success'>Selesai</span>";
        break;

    case self::STATUS_DITOLAK:
        $status = "<span class='badge badge-danger'>Ditolak</span>";
        break;
}

        return $status;
    }
}