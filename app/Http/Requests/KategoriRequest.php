<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class KategoriRequest extends FormRequest
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
        $kategoriId = $this->kategori->id; // Mendapatkan ID kategori yang sedang diupdate

        return [
            'name' => 'required|string',
            'kode_kategori' => [
                'required',
                'string',
                'max:3',
                'min:3',
                Rule::unique('kategoris')->ignore($kategoriId),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'kode_kategori' => Str::upper($this->kode_kategori)
        ]);
    }
}
