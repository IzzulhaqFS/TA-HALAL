<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class processBahanKritisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kelompok-bahan' => 'required|string',
        ];
    }


        /**
     * Get the custom attribute names for validator errors.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'kelompok-bahan' => 'Kelompok bahan',
            'bahan-kritis' => 'Bahan kritis',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'required' => ':attribute wajib terisi.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'integer' => ':attribute harus berupa angka.',
            'string' => ':attribute harus berupa teks.',
        ];
    }
}
