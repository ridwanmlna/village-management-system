<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    protected $table = 'surat_pengantar';

    protected $fillable = [
        'user_id',
        'jenis_pelayanan_id',
        'jenis_berkas',
        'file_berkas',
        'orginal_name_berkas',
        'status_pengajuan',
        'alasan_penolakan'
    ];

    const STATUS_MENUNGGU = 1;
    const STATUS_DITERIMA = 2;
    const STATUS_DIPROSES = 3;
    const STATUS_SELESAI = 4;
    const STATUS_DITOLAK = 5;

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

    switch ($this->status_pengajuan) {

        case self::STATUS_MENUNGGU:
            $status = "<span class='badge badge-info'>Menunggu Verifikasi</span>";
            break;

        case self::STATUS_DITERIMA:
            $status = "<span class='badge badge-primary'>Diterima</span>";
            break;

        case self::STATUS_DIPROSES:
            $status = "<span class='badge badge-warning'>Diproses</span>";
            break;

        case self::STATUS_SELESAI:
            $status = "<span class='badge badge-success'>Selesai</span>";
            break;

        case self::STATUS_DITOLAK:
            $status = "<span class='badge badge-danger'>Ditolak</span>";
            break;

        default:
            $status = "<span class='badge badge-secondary'>Tidak Diketahui</span>";
            break;
    }
        return $status;
    }
}
