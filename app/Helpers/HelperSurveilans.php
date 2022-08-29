<?php

namespace App\Helpers;
use Carbon\Carbon;

class HelperSurveilans
{
    public function __construct()
    {
        $this->helpers = new Helpers();
    }
    public function survStatusForm()
    {
        $data = [
            [
                'text' => 'Aktif',
                'value' => 'Y',
                'default' => 'selected',
            ],
            [
                'text' => 'Tidak Aktif',
                'value' => 'N',
                'default' => '',
            ],
        ];

        return collect($data);
    }

    public function survJenisIndikator()
    {
        $data = [
            [
                'text' => 'Nasional',
                'value' => 'nasional',
                'default' => 'selected',
            ],
            [
                'text' => 'Lokal',
                'value' => 'lokal',
                'default' => '',
            ],
        ];

        return collect($data);
    }

    public function survDataServicePasien()
    {
        $data = [
            [
                'text' => 'Pasien Rawat Jalan',
                'value' => '1',
            ],
            [
                'text' => 'Pasie Rawat Inap',
                'value' => '2',
            ],
            [
                'text' => 'Pasien IGD',
                'value' => '3',
            ],
            [
                'text' => 'Pasien Rawat Inap Status Pulang',
                'value' => '4',
            ],
        ];

        return $this->helpers->arrayToObject($data);

    }

    public function survIndikatorMutuNasional()
    {
        $data = [
            [
                'text' => 'Kepatuhan Identifikasi Pasien',
                'value' => '1',
            ],
            [
                'text' => 'Emrgency Respon Time',
                'value' => '2',
            ],
            [
                'text' => 'Waktu Tunggu Rawat Jalan',
                'value' => '3',
            ],
            [
                'text' => 'Penundaan Operasi Elektif',
                'value' => '4',
            ],
            [
                'text' => 'Kepatuhan Jam Visite Dokter Spesialis',
                'value' => '5',
            ],
            [
                'text' => 'Waktu Lapor Hasil Tes Kritis Laboratorium',
                'value' => '6',
            ],
            [
                'text' =>
                    'Kepatuhan Peggunaan Formularium Nasional Bagi RS Provider BPJS',
                'value' => '7',
            ],
            [
                'text' => 'Kepatuhan Penggunaan Formularium Non Provider BPJS',
                'value' => '8',
            ],
            [
                'text' => 'Kepatuhan Cuci Tangan',
                'value' => '9',
            ],
            [
                'text' =>
                    'Kepatuhan Upaya Pencegahan Risiko Cedera Akibat Pasien Jatuh pada Pasien Rawat Inap',
                'value' => '10',
            ],
            [
                'text' => 'Kepatuhan Terhadap Clinical Pathway',
                'value' => '11',
            ],
            [
                'text' => 'Kepuasan Pasien dan Keluarga',
                'value' => '12',
            ],
            [
                'text' => 'Kecepatan Respon Terhadap Komplain',
                'value' => '13',
            ],
        ];

        return $this->helpers->arrayToObject($data);
    }

    public function survJenisWebService(){
        $data = [
            [
                'value' => 'dataPasien',
                'text' => 'Data Service Pasien'
            ],
            [
                'value' => 'dataPelayanan',
                'text' => 'Data Service Pelayanan'
            ],
            [
                'value' => 'tools',
                'text' => 'Tools'
            ],
        ];

        return $this->helpers->arrayToObject($data);
    }

    public function survJenisFilter()
    {
        $data = [
            [
                'value' => 'ranap',
                'text' => 'Rawat Inap'
            ],
            [
                'value' => 'rajal',
                'text' => 'Rawat Jalan'
            ]
        ];

        return $this->helpers->arrayToObject($data);
    }
}
