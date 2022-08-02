<?php

namespace App\Http\Requests\FormBuilder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\Helpers;

class MasterFormRequest extends FormRequest
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
            'indikatorMutuId' => 'required',
            'jenisIndikator' => 'required',
            'judul' => 'required',
            'status' => 'required',
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
            'indikatorMutuId.required' => 'Indikator Mutu Tidak Boleh Kosong',
            'jenisIndikator.required' => 'Jenis Indikator Tidak Boleh Kosong',
            'judul.required' => 'Judul Tidak Boleh Kosong',
            'status.required' => 'Status Tidak Boleh Kosong',
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
