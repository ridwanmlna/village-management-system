<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Antrian;
use App\Models\Pengaduan;
use App\Models\Notifikasi;
use App\Models\SuratPengantar;
use App\Models\Surat;
use App\Http\Requests\Admin\UpdateStatusPengajuanRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminServiceController extends Controller
{
    // ========================
    //  DAFTAR ANTRIAN
    // ========================
    public function antrian()
    {
        $antrian = Antrian::with('user', 'jenisPelayanan')
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);

        return view('admin.layanan.antrian.index', compact('antrian'));
    }
    
    public function antrianDetail($id)
{
    $antrian = Antrian::with('user', 'jenisPelayanan')
        ->findOrFail($id);

    return view('admin.layanan.antrian.show', compact('antrian'));
}

    // ========================
    //  CETAK SURAT DARI ANTRIAN
    // ========================
    public function antrianCetak($id)
    {
        $data = Antrian::with('user', 'jenisPelayanan')->findOrFail($id);

        // Tentukan template surat & prefix
        $pelayanan = strtolower(trim($data->jenisPelayanan->nama_pelayanan));

        switch ($pelayanan) {
            case 'surat keterangan domisili':
                $template = 'surat.domisili';
                $prefix = 'SKD';
                break;
            case 'surat pengantar skck':
                $template = 'surat.skck';
                $prefix = 'SKCK';
                break;
            case 'surat keterangan tidak mampu (sktm)':
                $template = 'surat.sktm';
                $prefix = 'SKTM';
                break;
            case 'surat keterangan belum menikah, duda/janda':
                $template = 'surat.belum_menikah';
                $prefix = 'SKBM';
                break;
            case 'surat keterangan usaha':
                $template = 'surat.usaha';
                $prefix = 'SKU';
                break;
            default:
                $template = 'surat.lain';
                $prefix = 'LAIN';
                break;
        }

        $tahun = date('Y');

        if (!$data->nomor_surat || $data->tahun_surat != $tahun) {
            $last = Antrian::where('jenis_pelayanan_id', $data->jenis_pelayanan_id)
                ->where('tahun_surat', $tahun)
                ->orderBy('nomor_surat', 'desc')
                ->value('nomor_surat');

            $data->nomor_surat = $last ? $last + 1 : 1;
            $data->tahun_surat = $tahun;
            $data->save();
        }

        $data->prefix_surat = $prefix;

        // Format nomor surat lengkap dengan bulan Romawi
        $bulanRomawi = $this->getBulanRomawi(date('m'));
        $data->nomor_surat_format = sprintf('%03d/%s/DS-ML/%s/%s', $data->nomor_surat, $prefix, $bulanRomawi, $tahun);

        // Tempat & Tanggal Lahir rapih
        $data->ttl = ($data->user->tempat_tanggal_lahir ?? '') 
                     . ', ' . Carbon::parse($data->user->tanggal_lahir)->translatedFormat('d F Y');

        $pdf = Pdf::loadView($template, compact('data'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream("surat_" . $data->id . ".pdf");
    }

    // ========================
    //  HAPUS ANTRIAN
    // ========================
    public function antrianDestroy($id)
    {
        $antrian = Antrian::find($id);

        if (!$antrian) {
            return redirect()->back()->with('error', 'Data antrian tidak ditemukan.');
        }

        $antrian->delete();

        return redirect()->route('admin.antrian.index')->with('success', 'Data antrian berhasil dihapus.');
    }

// ========================
//  UPDATE STATUS ANTRIAN
// ========================
public function antrianUpdate(Request $request, $id)
{
    $data = $request->validate([
        'status_antrian' => 'required'
    ]);

    $antrian = Antrian::findOrFail($id);

    $antrian->update($data);
    
    switch ($antrian->status_antrian) {
    case 1:
        $status = 'Menunggu';
        break;
    case 2:
        $status = 'Dipanggil';
        break;
    case 3:
        $status = 'Selesai';
        break;
    case 4:
        $status = 'Ditolak';
        break;
    default:
        $status = 'Menunggu';
        break;
}

Notifikasi::create([
    'user_id' => $antrian->user_id,
    'status_notifikasi' => Notifikasi::STATUS_UNREAD,
    'judul_notifikasi' => 'Status antrian ' . $status,
    'isi_notifikasi' => 'Status antrian Anda telah berubah menjadi ' . $status . '. Silakan pantau secara berkala.',
    'link_notifikasi' => $antrian->id,
    'tipe_notifikasi' => Notifikasi::TYPE_ANTRIAN
]);

return redirect()
->route('admin.antrian.index') 
->with('success', 'Status antrian berhasil diubah!');
}
    // ========================
    //  PENGAJUAN
    // ========================
    public function pengajuan()
    {
        $pengajuan = SuratPengantar::orderBy('created_at', 'desc')
            ->orderBy('status_pengajuan', 'asc')
            ->paginate(20);

        return view('admin.layanan.pengajuan.index', compact('pengajuan'));
    }

    public function pengajuanDetail($id)
    {
        $pengajuan = SuratPengantar::findOrFail($id);

        return view('admin.layanan.pengajuan.show', compact('pengajuan'));
    }

    public function pengajuanUpdate(UpdateStatusPengajuanRequest $request, $id)
{
    $data = $request->validated();

    $pengajuan = SuratPengantar::findOrFail($id);

    // Update status
    $pengajuan->status_pengajuan = $data['status_pengajuan'];

    // Simpan alasan penolakan jika status = Ditolak
    if ($data['status_pengajuan'] == SuratPengantar::STATUS_DITOLAK) {
        $pengajuan->alasan_penolakan = $request->alasan_penolakan;
    } else {
        // Hapus alasan jika status diubah selain Ditolak
        $pengajuan->alasan_penolakan = null;
    }

    $pengajuan->save();

    switch ($pengajuan->status_pengajuan) {

        case SuratPengantar::STATUS_MENUNGGU:
            $status = 'Menunggu Verifikasi';
            break;

        case SuratPengantar::STATUS_DITERIMA:
            $status = 'Diterima';
            break;

        case SuratPengantar::STATUS_DIPROSES:
            $status = 'Diproses';
            break;

        case SuratPengantar::STATUS_SELESAI:
            $status = 'Selesai';
            break;

        case SuratPengantar::STATUS_DITOLAK:
            $status = 'Ditolak';
            break;

        default:
            $status = 'Menunggu Verifikasi';
            break;
    }

    // Isi notifikasi
    if ($pengajuan->status_pengajuan == SuratPengantar::STATUS_DITOLAK) {

        $isiNotifikasi = "Alasan Penolakan:\n";
$isiNotifikasi .= "•    " . $pengajuan->alasan_penolakan . "\n\n";
$isiNotifikasi .= "Silakan lengkapi atau perbaiki persyaratan yang diperlukan, kemudian ajukan kembali permohonan surat melalui Sistem Informasi Desa Margalaksana.";

    } else {

        $isiNotifikasi = "Status pengajuan {$status}. Silakan pantau status pengajuan Anda secara berkala.";

    }

    Notifikasi::create([
        'user_id' => $pengajuan->user_id,
        'status_notifikasi' => Notifikasi::STATUS_UNREAD,
        'judul_notifikasi' => 'Status pengajuan ' . $status,
        'isi_notifikasi' => $isiNotifikasi,
        'link_notifikasi' => $pengajuan->id,
        'tipe_notifikasi' => Notifikasi::TYPE_PENGAJUAN
    ]);

    return redirect()->route('admin.pengajuan.index')
        ->with('success', 'Status pengajuan berhasil diubah!');
}

    public function pengajuanDestroy($id)
    {
        $pengajuan = SuratPengantar::find($id);

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Data pengajuan tidak ditemukan.');
        }

        $pengajuan->delete();

        return redirect()->route('admin.pengajuan.index')->with('success', 'Data pengajuan berhasil dihapus.');
    }

    // ========================
    //  PENGADUAN
    // ========================
    public function pengaduan()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.layanan.pengaduan.index', compact('pengaduan'));
    }

    public function pengaduanDetail($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('admin.layanan.pengaduan.show', compact('pengaduan'));
    }

    public function pengaduanDestroy($id)
    {
        $pengaduan = Pengaduan::find($id);

        if (!$pengaduan) {
            return redirect()->back()->with('error', 'Data pengaduan tidak ditemukan.');
        }

        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Data pengaduan berhasil dihapus.');
    }
    
    // ========================
//  UPDATE STATUS PENGADUAN
// ========================
public function pengaduanUpdate(Request $request, $id)
{
    $data = $request->validate([
        'status_pengaduan' => 'required'
    ]);

    $pengaduan = Pengaduan::findOrFail($id);

    $pengaduan->update($data);

$status = $pengaduan->status_pengaduan;

return redirect()
    ->route('admin.pengaduan.index')
    ->with('success', 'Status pengaduan berhasil diubah!');

}
    // ========================
    //  PEMBUATAN SURAT
    // ========================
    public function indexPembuatanSurat()
    {
        return view('admin.layanan.pembuatan.cari-nik');
    }

    public function cariNikForm()
    {
        return view('admin.layanan.pembuatan.cari-nik');
    }

    public function cariNikSurat(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16'
        ]);

        $warga = User::where('nik', $request->nik)->first();

        if (!$warga) {
            return back()->with('error', 'NIK tidak ditemukan!');
        }

        return view('admin.layanan.pembuatan.pilih-jenis-surat', compact('warga'));
    }

    public function buatSurat($nik)
    {
        $warga = User::where('nik', $nik)->firstOrFail();

        return view('admin.layanan.pembuatan.form-buat-surat', compact('warga'));
    }

    // ========================
    //  PROSES TOMBOL "BUAT SURAT"
    // ========================
    public function tampilTemplateSurat(Request $request)
    {
        $warga = User::where('nik', $request->nik)->firstOrFail();
        $jenis = $request->jenis_surat;

        // ===== KHUSUS SKTM: REDIRECT KE FORM CARI NIK ORANG TUA =====
        if ($jenis === 'surat-keterangan-tidak-mampu-sekolah') {
            return redirect()->route('admin.surat.sktm.form');
        }

        // ===== SURAT LAINNYA =====
        $tahun = date('Y');

        // Tangkap input usaha sebelum switch
        $nama_usaha   = $request->input('nama_usaha', null);
        $alamat_usaha = $request->input('alamat_usaha', null);

        switch ($jenis) {
            case 'surat-pengantar-skck':
                $template = 'admin.layanan.pembuatan.form.surat-pengantar-skck';
                $prefix = 'SKCK';
                break;
            case 'surat-keterangan-domisili':
                $template = 'admin.layanan.pembuatan.form.surat-keterangan-domisili';
                $prefix = 'SKD';
                break;
            case 'surat-keterangan-tidak-mampu-umum':
                $template = 'admin.layanan.pembuatan.form.surat-keterangan-tidak-mampu-umum';
                $prefix = 'SKTM';
                break;
            case 'surat-keterangan-usaha':
                $template = 'admin.layanan.pembuatan.form.surat-keterangan-usaha';
                $prefix = 'SKU';
                break;
            case 'surat-keterangan-belum-menikah':
                $template = 'admin.layanan.pembuatan.form.surat-keterangan-belum-menikah';
                $prefix = 'SKBM';
                break;
             case 'surat-keterangan-kelahiran':
                $template = 'admin.layanan.pembuatan.form.surat-keterangan-kelahiran';
                $prefix = 'SKL';
                break;
             case 'surat-keterangan-kematian':
                $template = 'admin.layanan.pembuatan.form.surat-keterangan-kematian';
                $prefix = 'SKM';
                 break;
            default:
                $template = 'admin.layanan.pembuatan.form.lainnya';
                $prefix = 'LAIN';
                break;
        }

        $last = Surat::where('prefix_surat', $prefix)
            ->whereYear('cetak_at', $tahun)
            ->orderBy('nomor_surat_angka', 'desc')
            ->value('nomor_surat_angka');

        $nomorUrut = $last ? $last + 1 : 1;
        $bulanRomawi = $this->getBulanRomawi(date('m'));
        $nomor_surat_format = sprintf('%03d/%s/DS-ML/%s/%s', $nomorUrut, $prefix, $bulanRomawi, $tahun);

        $surat = Surat::create([
            'user_id' => $warga->id,
            'prefix_surat' => $prefix,
            'nomor_surat_angka' => $nomorUrut,
            'nomor_surat' => $nomor_surat_format,
            'cetak_at' => now(),
        ]);

        $data = (object)[
            'user' => $warga,
            'nomor_surat' => $nomorUrut,
            'prefix_surat' => $prefix,
            'tahun_surat' => $tahun,
            'nomor_surat_format' => $nomor_surat_format,
            'ttl' => ($warga->tempat_tanggal_lahir ?? '') 
                     . ', ' . Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y'),

            // Tambahkan data usaha jika SKU
            'nama_usaha' => $jenis === 'surat-keterangan-usaha' ? $nama_usaha : null,
            'alamat_usaha' => $jenis === 'surat-keterangan-usaha' ? $alamat_usaha : null,
        ];

        $pdf = Pdf::loadView($template, compact('data'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('Surat_'.$prefix.'_'.$nomorUrut.'.pdf');
    }

    // ========================
    // SKTM - ALUR BARU (SUDAH DIPERBAIKI)
    // ========================
    public function formCariAnak()
    {
        return view('admin.layanan.pembuatan.cari-anak');
    }

    public function cariAnak(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16'
        ]);

        $warga = User::where('nik', $request->nik)->first();

        if (!$warga) {
            return back()->with('error', 'Data anak tidak ditemukan!');
        }

        return view('admin.layanan.pembuatan.data-anak', compact('warga'));
    }

    public function formCariOrangTua($nik_anak)
    {
        return view('admin.layanan.pembuatan.cari-orang-tua', compact('nik_anak'));
    }

    public function cariOrangTua(Request $request)
    {
        $request->validate([
            'nik_anak' => 'required',
            'nik_ortu' => 'required|digits:16'
        ]);

        $anak = User::where('nik', $request->nik_anak)->first();
        $ortu = User::where('nik', $request->nik_ortu)->first();

        if (!$anak) {
            return back()->with('error', 'Data anak tidak ditemukan!');
        }

        if (!$ortu) {
            return back()->with('error', 'Data orang tua tidak ditemukan!');
        }

        // Format TTL rapi
        $anakTTL = ($anak->tempat_lahir ?? '') . ', ' . 
           Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y');

        $ortuTTL = ($ortu->tempat_lahir ?? '') . ', ' . 
           Carbon::parse($ortu->tanggal_lahir)->translatedFormat('d F Y');

        return view('admin.layanan.pembuatan.data-orang-tua', compact('anak', 'ortu'));
    }

    public function cetakSktm(Request $request)
    {
        $anak = User::where('nik', $request->anak)->firstOrFail();
        $ortu = User::where('nik', $request->ortu)->firstOrFail();

        // Format TTL
        $anakTTL = ($anak->tempat_lahir ?? '') . ', ' . 
           Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y');

        $ortuTTL = ($ortu->tempat_lahir ?? '') . ', ' . 
           Carbon::parse($ortu->tanggal_lahir)->translatedFormat('d F Y');

        // Generate nomor surat
        $prefix = 'SKTM';
        $tahun = date('Y');
        $last = Surat::where('prefix_surat', $prefix)
            ->whereYear('cetak_at', $tahun)
            ->orderBy('nomor_surat_angka', 'desc')
            ->value('nomor_surat_angka');

        $nomorUrut = $last ? $last + 1 : 1;
        $bulanRomawi = $this->getBulanRomawi(date('m'));

        $nomor_surat_format = sprintf('%03d/%s/DS-ML/%s/%s',
            $nomorUrut, $prefix, $bulanRomawi, $tahun
        );

        // Simpan surat
        Surat::create([
            'user_id' => $anak->id,
            'prefix_surat' => $prefix,
            'nomor_surat_angka' => $nomorUrut,
            'nomor_surat' => $nomor_surat_format,
            'cetak_at' => now(),
        ]);

        // Siapkan data PDF
        $data = (object)[
            "anak" => $anak,
            "ortu" => $ortu,
            "nomor_surat_format" => $nomor_surat_format,
            "prefix_surat" => $prefix,
            "tahun_surat" => $tahun
        ];

        // CETAK PDF
        $pdf = Pdf::loadView('admin.layanan.pembuatan.form.surat-keterangan-tidak-mampu-sekolah', compact('data'))
                ->setPaper('a4', 'portrait');

        return $pdf->stream('Surat_SKTM_'.$nomorUrut.'.pdf');
    }

    // ========================
//  REKAP SURAT (TAMPIL DI WEBSITE)
// ========================
public function rekapSurat()
{
    // Set locale Carbon ke Bahasa Indonesia
    Carbon::setLocale('id');

    // Ambil semua surat, urut terbaru
    $surat = Surat::orderBy('created_at', 'asc')->get();

    // Hitung jumlah per jenis surat
    $rekapJenis = Surat::select('prefix_surat')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('prefix_surat')
        ->get();

    return view('admin.layanan.rekap.index', compact('surat', 'rekapJenis'));
}

// ========================
//  REKAP SURAT (DOWNLOAD PDF)
// ========================
public function downloadRekapSurat()
{
    // Set locale Carbon ke Bahasa Indonesia
    Carbon::setLocale('id');

    // Ambil semua surat, urut terbaru
    $surat = Surat::orderBy('created_at', 'asc')->get();

    // Rekap jumlah surat per prefix_surat
    $rekapPerTahun = Surat::select('prefix_surat')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('prefix_surat')
        ->get()
        ->pluck('total', 'prefix_surat'); // key = prefix_surat, value = total

    // Load view PDF
    $pdf = Pdf::loadView('admin.layanan.rekap.pdf', compact('surat', 'rekapPerTahun'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('rekap-surat.pdf');
}

// ========================
//  HAPUS DATA REKAP SURAT
// ========================
public function deleteSurat($id)
{
    $surat = Surat::find($id);

    if (!$surat) {
        return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
    }

    $surat->delete();

    return redirect()->back()->with('success', 'Data surat berhasil dihapus.');
}

// ========================
//  PRINT ULANG SURAT DARI REKAP
// ========================
public function printUlangSurat($id)
{
    $surat = Surat::with('user')->findOrFail($id);

    $prefix = strtolower($surat->prefix_surat);

    switch ($prefix) {
        case 'skck':
            $template = 'admin.layanan.pembuatan.form.surat-pengantar-skck';
            break;
        case 'skd':
            $template = 'admin.layanan.pembuatan.form.surat-keterangan-domisili';
            break;
        case 'sktm':
            $template = 'admin.layanan.pembuatan.form.surat-keterangan-tidak-mampu-umum';
            break;
        case 'sku':
            $template = 'admin.layanan.pembuatan.form.surat-keterangan-usaha';
            break;
        case 'skbm':
            $template = 'admin.layanan.pembuatan.form.surat-keterangan-belum-menikah';
            break;
        case 'skl':
            $template = 'admin.layanan.pembuatan.form.surat-keterangan-kelahiran';
            break;
        case 'skm':
            $template = 'admin.layanan.pembuatan.form.surat-keterangan-kematian';
            break;
        default:
            $template = 'admin.layanan.pembuatan.form.lainnya';
            break;
    }

    $data = (object)[
        'user' => $surat->user,
        'nomor_surat' => $surat->nomor_surat_angka,
        'prefix_surat' => $surat->prefix_surat,
        'tahun_surat' => date('Y', strtotime($surat->cetak_at)),
        'nomor_surat_format' => $surat->nomor_surat,
        'ttl' => ($surat->user->tempat_tanggal_lahir ?? '') 
                . ', ' . Carbon::parse($surat->user->tanggal_lahir)->translatedFormat('d F Y'),
    ];

    $pdf = Pdf::loadView($template, compact('data'))
              ->setPaper('a4', 'portrait');

    return $pdf->stream('Surat_'.$surat->prefix_surat.'_'.$surat->nomor_surat_angka.'.pdf');
}

    // ========================
    //  METHOD UNTUK KONVERSI BULAN KE ROMAWI
    // ========================
    private function getBulanRomawi($bulan)
    {
        $romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        $index = intval($bulan) - 1;
        return $romawi[$index] ?? '';
    }
}
