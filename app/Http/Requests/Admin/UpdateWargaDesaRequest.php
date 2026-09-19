<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWargaDesaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'max:16', 'unique:users,nik,' . $this->id],
            'name' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'max:1', 'in:L,P'],
            'alamat' => ['required', 'string'],

            // Tambahan field dari edit.blade.php
            'tempat_tanggal_lahir' => ['nullable', 'string', 'max:255'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'warga_negara' => ['nullable', 'string', 'max:50'],
            'agama' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nik.required' => 'NIK harus diisi',
            'nik.string' => 'NIK harus berupa string',
            'nik.max' => 'NIK maksimal 16 karakter',
            'nik.unique' => 'NIK sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'jenis_kelamin.string' => 'Jenis kelamin harus berupa string',
            'jenis_kelamin.max' => 'Jenis kelamin maksimal 1 karakter',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa string',

            // Pesan khusus untuk field tambahan
            'tempat_tanggal_lahir.string' => 'Tempat & tanggal lahir harus berupa string',
            'tempat_tanggal_lahir.max' => 'Tempat & tanggal lahir maksimal 255 karakter',
            'status_perkawinan.string' => 'Status perkawinan harus berupa string',
            'status_perkawinan.max' => 'Status perkawinan maksimal 50 karakter',
            'warga_negara.string' => 'Warga negara harus berupa string',
            'warga_negara.max' => 'Warga negara maksimal 50 karakter',
            'agama.string' => 'Agama harus berupa string',
            'agama.max' => 'Agama maksimal 50 karakter',
            'pekerjaan.string' => 'Pekerjaan harus berupa string',
            'pekerjaan.max' => 'Pekerjaan maksimal 100 karakter',
        ];
    }
}
