<?php

namespace App\Imports;

use App\Models\MahasiswaBaru;
use App\Models\ReportMahasiswaBaru;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaBaruImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = ReportMahasiswaBaru::where('periode', request('periode'))->first();

        return new MahasiswaBaru([
            'id_report_maba'  => $data->id,            
            'nama_lengkap'    => $row['nama_lengkap'],
            'prodi1'          => $row['prodi1'],
            'prodi2'          => $row['prodi2'],
            'prodi3'          => $row['prodi3'],
            'prodi4'          => $row['prodi4'],
            'prodi5'          => $row['prodi5'],
            'periode'         => $data->periode,
            'status_kelulusan'=> $row['status_kelulusan'],
        ]);        
    }

    public function rules(): array
    {
        return [
            '*.virtual_account' => ['unique:ms_maba,virtual_account'],
            // '*.email' => ['unique:ms_maba,email']
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }
}
    