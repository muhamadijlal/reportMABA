<?php

namespace App\Exports;

use App\Models\MahasiswaBaru;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaBaruExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return MahasiswaBaru::all();
    }
}
