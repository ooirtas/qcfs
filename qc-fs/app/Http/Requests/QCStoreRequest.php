<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QCStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kode_proses' => 'required|string|max:255',
            'layak' => 'integer|min:0',
            'reject' => 'integer|min:0',
            'repair' => 'integer|min:0',
            'repair_description' => 'string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'kode_proses.required' => 'Nama Proses wajib diisi.',
            'layak.integer' => 'Layak must be a number.',
            'reject.integer' => 'Reject must be a number.',
            'repair.integer' => 'Repair must be a number.',
        ];
    }
}

