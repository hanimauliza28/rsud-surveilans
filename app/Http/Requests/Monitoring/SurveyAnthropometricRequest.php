<?php

namespace App\Http\Requests\Monitoring;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\Helpers;

class SurveyAnthropometricRequest extends FormRequest
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
            'tanggalSurvey' => 'required',
            'umur' => 'required',
            'bb' => 'required|numeric',
            'tb' => 'required|numeric'
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
            'tanggalSurvey.required' => 'Tanggal Survey Tidak Boleh Kosong',
            'umur.required' => 'Umur Tidak Boleh Kosong',
            'bb.required' => 'Berat Badan Tidak Boleh Kosong',
            'bb.numeric' => 'Berat Badan Harus Berupa Angka,Gunakan . (titik) untuk angka desimal',
            'tb.numeric' => 'Tinggi Badan Harus Berupa Angka,Gunakan . (titik) untuk angka desimal',
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
