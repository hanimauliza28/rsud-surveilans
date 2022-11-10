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

    public function filterRawatInap()
    {
        $data = [
            [
                'value' => 'dalamPerawatan',
                'text' => 'Dalam Perawatan',
            ],
            [
                'value' => 'pulang',
                'text' => 'Pulang',
            ],
            [
                'value' => 'rujuk',
                'text' => 'Rujuk',
            ],
            [
                'value' => 'meninggal',
                'text' => 'Meninggal',
            ]
        ];

        return $this->helpers->arrayToObject($data);
    }

    function labelStatusPanggil($status)
    {
        if($status == 'P')
        {
            $result = '<div class="badge text-success bg-light-success">Panggil</div>';
        }elseif($status == 'T')
        {
            $result = '<div class="badge text-warning bg-light-warning">Tunda</div>';
        }elseif($status == 'D')
        {
            $result = '<div class="badge text-success bg-light-success">Sudah</div>';
        }else{
            $result = '<div class="badge text-danger bg-light-danger">Belum di Panggil</div>';
        }

        return $result;
    }


    function labelStatusDilayani($status)
    {
        if($status == 'Y')
        {
            $result = '<div class="badge text-success bg-light-success">Sudah</div>';
        }elseif($status == 'N')
        {
            $result = '<div class="badge text-warning bg-light-warning">Belum</div>';
        }else{
            $result = '<div class="badge text-danger bg-light-danger">Belum di Panggil</div>';
        }

        return $result;
    }

    function listJenisMenu()
    {
        $data = [
            [
                'value' => 'section',
                'text' => 'Menu Section',
            ],
            [
                'value' => 'parent',
                'text' => 'Menu Utama',
            ],
            [
                'value' => 'child',
                'text' => 'Sub Menu',
            ],
        ];

        return $this->helpers->arrayToObject($data);
    }


    function listLevelUser()
    {
        $data = [
            [
                'value' => '1',
                'text' => 'Superadmin',
            ],
            [
                'value' => '2',
                'text' => 'Administrator',
            ],
            [
                'value' => '3',
                'text' => 'Surveyor',
            ],
        ];

        return $this->helpers->arrayToObject($data);
    }


    function labelLevelUser($level)
    {
        if($level == '1')
        {
            $result = '<div class="badge text-success bg-light-success">Superadmin</div>';
        }elseif($level == '2')
        {
            $result = '<div class="badge text-warning bg-light-warning">Administator</div>';
        }else{
            $result = '<div class="badge text-primary bg-light-primary">Surveyor</div>';
        }

        return $result;
    }


    function listStatusUser()
    {
        $data = [
            [
                'value' => 'Y',
                'text' => 'Aktif',
            ],
            [
                'value' => 'N',
                'text' => 'Tidak',
            ]
        ];

        return $this->helpers->arrayToObject($data);
    }


    function labelStatusUser($status)
    {
        if($status == 'Y')
        {
            $result = '<div class="badge text-success bg-light-success">Aktif</div>';
        }else{
            $result = '<div class="badge text-danger bg-light-primary">Tidak Aktif</div>';
        }

        return $result;
    }
}
