<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'name' => 'required|string|unique:barangs',
            'jumlah_stok' => 'required|integer',
            'stok_minimum' => 'required|integer',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
        ];
    }
}
