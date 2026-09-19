<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Antrian;
use App\Models\Notifikasi;
use App\Models\Pengaduan;
use App\Models\SuratPengantar;
use App\Models\Surat;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboardUser()
    {
        $jumlah_notifikasi = Notifikasi::where('user_id', auth()->user()->id)
            ->where('status_notifikasi', Notifikasi::STATUS_UNREAD)
            ->count() ?? 0;

        return view('users.dashboard', compact('jumlah_notifikasi'));
    }

    public static function notifkasi()
    {
        $notifikasi = Notifikasi::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $jumlah_notifikasi = Notifikasi::where('user_id', auth()->user()->id)
            ->where('status_notifikasi', Notifikasi::STATUS_UNREAD)
            ->count() ?? 0;

        return view('users.notifikasi', compact('notifikasi', 'jumlah_notifikasi'));
    }
    
    public function deleteNotifikasi($id)
{
    $notifikasi = Notifikasi::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if (!$notifikasi) {
        return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
    }

    $notifikasi->delete();

    return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
}

    public function dashboardAdmin()
    {
        // Get waktu sekarang
        $waktu = \Carbon\Carbon::now()->format('H:i');

        if ($waktu > '00:00' && $waktu < '10:00') {
            $salam = 'Selamat Pagi';
        } elseif ($waktu >= '10:00' && $waktu < '15:00') {
            $salam = 'Selamat Siang';
        } elseif ($waktu >= '15:00' && $waktu < '18:00') {
            $salam = 'Selamat Sore';
        } else {
            $salam = 'Selamat Malam';
        }

        // =========================
        // DATA DASHBOARD LAMA
        // =========================
        $jumlah_antrian = Antrian::where('created_at', 'like', date('Y-m-d') . '%')->count() ?? 0;

        $jumlah_pengajuan = SuratPengantar::where(
            'status_pengajuan',
            SuratPengantar::STATUS_MENUNGGU
        )->count() ?? 0;

        $jumlah_pengaduan = Pengaduan::count() ?? 0;

        // =========================
        // STATISTIK SURAT BARU
        // =========================

        // Surat hari ini
        $surat_hari_ini = Surat::whereDate('created_at', Carbon::today())
            ->count();

        // Surat bulan ini
        $surat_bulan_ini = Surat::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Surat tahun ini
        $surat_tahun_ini = Surat::whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('admin.dashboard', compact(
            'salam',
            'jumlah_antrian',
            'jumlah_pengajuan',
            'jumlah_pengaduan',
            'surat_hari_ini',
            'surat_bulan_ini',
            'surat_tahun_ini'
        ));
    }
}