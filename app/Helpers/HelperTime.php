<?php
namespace App\Helpers;
use Carbon\Carbon;

class HelperTime {

    public function formatTanggalNoreg($date){
        $default = Carbon::parse(date('Y-m-d', strtotime($date)));
        $newDate = $default->isoFormat('YYYYMMDD');
        return $newDate;
    }


    public function formatTanggalDatabase($date){
        $waktu = explode('/', $date);

        $newDate = $waktu[2].'-'.$waktu[1].'-'.$waktu[0];
        return $newDate;
    }

    public function splitFilterBatasWaktu($filterBatasWaktu)
    {
        // Filter
        $now = date('Y-m-d');

        $batasWaktu = explode(' - ', $filterBatasWaktu);

        $batasWaktuMulai = date('Y-m-d', strtotime(str_replace('/', '-', $batasWaktu[0])));
        $batasWaktuSelesai = date('Y-m-d', strtotime(str_replace('/', '-', $batasWaktu[1])));

        return collect([
            'batasWaktuMulai' => $batasWaktuMulai,
            'batasWaktuSelesai' => $batasWaktuSelesai
        ]);

    }

    public function monthNow($date = null)
    {
        if($date)
        {
            $startDate = Carbon::parse(date('Y-m-d', strtotime($date)));

        }else{
            $startDate = Carbon::now(); //returns current day
        }

        $dayInMonth = $startDate->lastOfMonth()->isoFormat('DD');
        $month = $startDate->firstOfMonth()->isoFormat('MM');
        $year = $startDate->firstOfMonth()->isoFormat('YYYY');
        $firstDay = $startDate->firstOfMonth()->isoFormat('DD/MM/YYYY');
        $lastDay = $startDate->lastOfMonth()->isoFormat('DD/MM/YYYY');

        $data = [
            'date' => $startDate,
            'dayInMonth' => $dayInMonth,
            'month' => $month,
            'year' => $year,
            'firstDay' => $firstDay,
            'lastDay' => $lastDay,
        ];

        return collect($data);
    }

    public function dataMonth($date = null)
    {
        $startDate = Carbon::parse($date);

        $firstDay = $startDate->firstOfMonth()->isoFormat('DD/MM/YYYY');
        $lastDay = $startDate->lastOfMonth()->isoFormat('DD/MM/YYYY');
        $dayInMonth = $startDate->lastOfMonth()->isoFormat('DD');

        $data = [
            'today' => $startDate,
            'firstDay' => $firstDay,
            'lastDay' => $lastDay,
            'dayInMonth' => $dayInMonth
        ];

        return collect($data);
    }

    public function listBulan()
    {
        $data = [
            [
                'value' => '01',
                'text' => 'Januari'
            ],
            [
                'value' => '02',
                'text' => 'Februari'
            ],
            [
                'value' => '03',
                'text' => 'Maret'
            ],
            [
                'value' => '04',
                'text' => 'April'
            ],
            [
                'value' => '05',
                'text' => 'Mei'
            ],
            [
                'value' => '06',
                'text' => 'Juni'
            ],
            [
                'value' => '07',
                'text' => 'Juli'
            ],
            [
                'value' => '08',
                'text' => 'Agustus'
            ],
            [
                'value' => '09',
                'text' => 'September'
            ],
            [
                'value' => '10',
                'text' => 'Oktober'
            ],
            [
                'value' => '11',
                'text' => 'November'
            ],
            [
                'value' => '12',
                'text' => 'Desember'
            ],
        ];

        return collect($data);
    }



    // public function secondMinute($seconds){

    //     /// get minutes
    //     $minResult = floor($seconds/60);

    //     /// if minutes is between 0-9, add a "0" --> 00-09
    //     if($minResult < 10){$minResult = 0 . $minResult;}

    //     /// get sec
    //     $secResult = ($seconds/60 - $minResult)*60;

    //     /// if secondes is between 0-9, add a "0" --> 00-09
    //     if($secResult < 10){$secResult = 0 . $secResult;}

    //     /// return result
    //     return $minResult." menit ". $secResult." detik";

    // }



    // public function secondHour($seconds){

    //     /// get minutes
    //     $hourResult = floor($seconds/3600);

    //     /// if minutes is between 0-9, add a "0" --> 00-09
    //     if($hourResult < 10){$hourResult = 0 . $hourResult;}

    //     /// get minutes
    //     $minResult = floor($seconds/60);

    //     /// if minutes is between 0-9, add a "0" --> 00-09
    //     if($minResult < 10){$minResult = 0 . $minResult;}

    //     /// get sec
    //     $secResult = ($seconds/60 - $minResult)*60;

    //     /// if secondes is between 0-9, add a "0" --> 00-09
    //     if($secResult < 10){$secResult = 0 . $secResult;}

    //     /// return result
    //     return $minResult." jam ". $minResult." menit ". $secResult." detik";

    // }


}
