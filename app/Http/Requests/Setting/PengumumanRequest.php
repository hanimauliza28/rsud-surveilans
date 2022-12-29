<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\Helpers;

class PengumumanRequest extends FormRequest
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->helpers = new Helpers;
    }

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
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'required',
            'deskripsiSingkat' => 'required',
            'isi' => 'required',
            'status' => 'required'
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'judul.required' => 'Judul Tidak Boleh Kosong',
            'deskripsiSingkat.required' => 'Deskripsi Singkat Tidak Boleh Kosong',
            'isi.required' => 'Isi Tidak Boleh Kosong',
            'status.required' => 'Status Tampil Harus di Pilih'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->helpers->retunJson(422, 'Inputan Error. Mohon Cek Ulang', $validator->errors()));
    }
}
