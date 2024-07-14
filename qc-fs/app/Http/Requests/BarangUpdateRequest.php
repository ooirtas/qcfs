<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BarangUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_barang' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'id.unique' => 'ID Barang sudah digunakan.',
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'nama_barang.string' => 'Nama Barang harus berupa teks.',
            'nama_barang.max' => 'Nama Barang tidak boleh lebih dari :max karakter.',
            'Jenis_barang.required' => 'Jenis Barang wajib diisi.',
            'Jenis_barang.string' => 'Jenis Barang harus berupa teks.',
            'Jenis_barang.max' => 'Jenis Barang tidak boleh lebih dari :max karakter.',
        ];
    }

}
