<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduksiStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_produksi' => 'required|string|max:100',
            'id_barang' => 'required',
            'jumlah_produksi' => 'required',
            'jumlah_proses' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nama_produksi.required' => 'Nama produksi wajib diisi.',
            'nama_produksi.string' => 'Nama produksi harus berupa teks.',
            'nama_produksi.max' => 'Nama produksi tidak boleh lebih dari :max karakter.',
            'id_barang.required' => 'Nama Barang wajib diisi.',
            'jumlah_produksi.required' => 'Jumlah produksi wajib diisi.',
            'jumlah_proses.required' => 'Jumlah Proses wajib diisi.',
        ];
    }

}
