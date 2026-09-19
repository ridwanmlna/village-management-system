<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';

    protected $fillable = [
        'user_id',
        'jenis_pelayanan_id',
        'status_antrian',
        'no_antrian',
    ];

    // ========================
    // STATUS ANTRIAN
    // ========================

    const STATUS_MENUNGGU = 1;
    const STATUS_DIPANGGIL = 2;
    const STATUS_SELESAI = 3;
    const STATUS_DITOLAK = 4;

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function jenisPelayanan()
    {
        return $this->belongsTo(JenisPelayanan::class);
    }

    public function getStatusAttribute()
    {
        $status = '';

        switch ($this->status_antrian) {

            case self::STATUS_MENUNGGU:
                $status = "<span class='badge badge-info'>Menunggu Dipanggil</span>";
                break;

            case self::STATUS_DIPANGGIL:
                $status = "<span class='badge badge-success'>Dipanggil</span>";
                break;

            case self::STATUS_DITOLAK:
                $status = "<span class='badge badge-danger'>Ditolak</span>";
                break;

            case self::STATUS_SELESAI:
                $status = "<span class='badge badge-primary'>Selesai</span>";
                break;
            
            default:
            $status = "<span class='badge badge-secondary'>Tidak Diketahui</span>";
            break;
        }

        return $status;
    }
}