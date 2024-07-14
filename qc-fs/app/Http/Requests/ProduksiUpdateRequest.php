<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProduksiUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_produksi' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nama_produksi.required' => 'Nama Barang wajib diisi.',
            'nama_produksi.string' => 'Nama Barang harus berupa teks.',
            'nama_produksi.max' => 'Nama Barang tidak boleh lebih dari :max karakter.',
        ];
    }

}
