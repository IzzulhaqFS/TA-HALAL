<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
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
            'is-halal-certified' => 'required',
            'certificate-number' => 'required',
            'certificate-institution' => 'required',
            'certificate-start-date' => 'required',
            'certificate-end-date' => 'required',
            'ingredient_id' => 'required',
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
            'is-halal-certified' => 'Apakah Bahan Telah Bersertifikat Halal?',
            'certificate-number' => 'Nomor Sertifikat',
            'certificate-institution' => 'Lembaga Penerbit Sertifikat',
            'certificate-start-date' => 'Mulai Masa Berlaku',
            'certificate-end-date' => 'Akhir Masa Berlaku',
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
