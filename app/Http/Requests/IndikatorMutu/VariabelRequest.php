<?php

namespace App\Http\Requests\IndikatorMutu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\Helpers;

class VariabelRequest extends FormRequest
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
            'indikatorId' => 'required',
            'tipeVariabel' => 'required',
            'indikatorVariabel' => 'required',
            'satuanVariabel' => 'required',
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
            'indikatorId.required' => 'Kategori Indikator Tidak Boleh Kosong',
            'tipeVariabel.required' => 'Judul Indikator Tidak Boleh Kosong',
            'indikatorVariabel.required' => 'Definisi Operasional Tidak Boleh Kosong',
            'satuanVariabel.required' => 'Kriteria Inklusi Tidak Boleh Kosong',
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
