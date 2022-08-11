<?php

namespace App\Http\Requests\IndikatorMutu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\Helpers;

class IndikatorMutuLokalRequest extends FormRequest
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
            'kategoriIndikator' => 'required',
            'judulIndikator' => 'required',
            // 'namaRoute' => 'required',
            'definisiOperasional' => 'required',
            'kriteriaInklusi' => 'required',
            'kriteriaEksklusi' => 'required',
            'sumberData' => 'required',
            'tipeIndikator' => 'required',
            'areaMonitoring' => 'required',
            'standar' => 'required',
            'faktorPengali' => 'required',
            'satuan' => 'required',
            'frekuensi' => 'required',
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
            'kategoriIndikator.required' => 'Kategori Indikator Tidak Boleh Kosong',
            'judulIndikator.required' => 'Judul Indikator Tidak Boleh Kosong',
            'namaRoute.required' => 'Nama Function Tidak Boleh Kosong',
            'definisiOperasional.required' => 'Definisi Operasional Tidak Boleh Kosong',
            'kriteriaInklusi.required' => 'Kriteria Inklusi Tidak Boleh Kosong',
            'kriteriaEksklusi.required' => 'Kriteria Eksklusi Tidak Boleh Kosong',
            'sumberData.required' => 'Sumber Data Tidak Boleh Kosong',
            'areaMonitoring.required' => 'Area Monitoring Tidak Boleh Kosong',
            'frekuensi.required' => 'Frekuensi Tidak Boleh Kosong',
            'standar.required' => 'Standart Tidak Boleh Kosong',
            'faktorPengali.required' => 'Faktor Pengali Tidak Boleh Kosong',
            'satuan.required' => 'Satuan Tidak Boleh Kosong',
            'tipeIndikator.required' => 'Tipe Indikator Tidak Boleh Kosong',
            ''
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
