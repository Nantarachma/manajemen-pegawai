<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pegawaiId = $this->route('pegawai');

        return [
            'nip' => 'required|string|max:50|unique:pegawais,nip,' . $pegawaiId,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string|in:SMA/SMK,D3,S1,S2,S3',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih.',
            'pendidikan_terakhir.in' => 'Pendidikan terakhir tidak valid.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }

    /**
     * Get only the validated and allowed fields.
     */
    public function safeData(): array
    {
        return $this->only(['nip', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'pendidikan_terakhir', 'jabatan', 'alamat']);
    }
}
