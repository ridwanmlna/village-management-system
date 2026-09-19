<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'max:16', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'tempat_tanggal_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'agama' => ['required', 'string', 'max:50'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:1', 'in:L,P'],
            'alamat' => ['required', 'string'],
        ];
    }

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
            'tempat_tanggal_lahir.required' => 'Tempat & tanggal lahir harus diisi',
            'tempat_tanggal_lahir.string' => 'Tempat & tanggal lahir harus berupa string',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'agama.required' => 'Agama harus dipilih',
            'pekerjaan.required' => 'Pekerjaan harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
            'alamat.required' => 'Alamat harus diisi',
        ];
    }
}
