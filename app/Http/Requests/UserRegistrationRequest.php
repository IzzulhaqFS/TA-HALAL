<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|max:100',
            'id_card' => 'required|string',
            'phone' => 'required|string',
            'umkm_name' => 'required|string',
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
            'name' => 'nama',
            'id_card' => 'NIK',
            'phone' => 'telepon',
            'umkm_name' => 'nama UMKM',
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
            'confirmed' => 'konfirmasi :attribute harus sesuai.',
        ];
    }
}
