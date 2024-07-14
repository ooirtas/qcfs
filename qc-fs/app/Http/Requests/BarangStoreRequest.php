<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangStoreRequest extends FormRequest
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
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang tidak boleh lebih dari :max karakter.',
            'jenis_barang.required' => 'Jenis barang wajib diisi.',
            'jenis_barang.string' => 'Jenis barang harus berupa teks.',
            'jenis_barang.max' => 'Jenis barang tidak boleh lebih dari :max karakter.',
        ];
    }

}
