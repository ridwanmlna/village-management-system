<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Admin\UpdateWargaDesaRequest;
use Illuminate\Http\Request;

class WargaDesaController extends Controller
{
    public function index(Request $request)
{
    $query = User::where('user_type', User::USER_TYPE_USER);

    // fitur pencarian
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nik', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }

    $warga_desa = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.warga-desa.index', compact('warga_desa'));
}

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        // Hapus strip pada nomor HP jika ada
        if (isset($data['phone_number'])) {
            $data['phone_number'] = str_replace('-', '', $data['phone_number']);
        }

        // Pastikan tanggal lahir selalu ada
        if (empty($data['tanggal_lahir']) && isset($data['tempat_tanggal_lahir'])) {
            if (preg_match('/^(.*)\s(\d{1,2}\s\w+\s\d{4})$/', $data['tempat_tanggal_lahir'], $matches)) {
                $data['tempat_tanggal_lahir'] = trim($matches[1]);
                $data['tanggal_lahir'] = trim($matches[2]);
            } else {
                $data['tanggal_lahir'] = now()->format('Y-m-d');
            }
        }

        // Tambahan field baru: status perkawinan & warga negara
        $data['status_perkawinan'] = $request->status_perkawinan ?? null;
        $data['warga_negara'] = $request->warga_negara ?? null;

        // Set user type
        $data['user_type'] = User::USER_TYPE_USER;

        // Generate password berdasarkan tanggal lahir
        $password = Carbon::parse($data['tanggal_lahir'])->format('dmY');
        $data['password'] = Hash::make($password);

        User::create($data);

        return redirect()->route('warga.desa.index')
            ->with('success', 'Berhasil menambahkan data warga desa');
    }

    public function show($id)
    {
        $warga_desa = User::findOrFail($id);
        return view('admin.warga-desa.show', compact('warga_desa'));
    }

    public function edit($id)
    {
        $warga_desa = User::findOrFail($id);
        return view('admin.warga-desa.edit', compact('warga_desa'));
    }

    public function update(UpdateWargaDesaRequest $request, $id)
    {
        $warga_desa = User::findOrFail($id);

        $warga_desa->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'warga_negara' => $request->warga_negara,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'password' => Hash::make(Carbon::parse($request->tanggal_lahir)->format('dmY')),
        ]);

        return redirect()->route('warga.desa.index')
            ->with('success', 'Berhasil mengubah data warga desa');
    }

    // ====================== PERBAIKAN ======================
    // Tambahkan method destroy agar bisa menghapus data
    public function destroy($id)
    {
        $warga_desa = User::findOrFail($id);
        $warga_desa->delete();

        return redirect()->route('warga.desa.index')
            ->with('success', 'Data warga desa berhasil dihapus');
    }
}
