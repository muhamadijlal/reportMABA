<?php

namespace App\Imports;

use App\Models\MahasiswaBaru;
use App\Models\ReportMahasiswaBaru;
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
            'prodi2'          => isset($row['prodi2']) ? $row['prodi2'] : null,
            'prodi3'          => isset($row['prodi3']) ? $row['prodi3'] : null,
            'prodi4'          => isset($row['prodi4']) ? $row['prodi4'] : null,
            'prodi5'          => isset($row['prodi5']) ? $row['prodi5'] : null,
            'transfer'        => $row['transfer'],
            'gelombang'       => $row['gelombang'],
            'ujian'           => $row['ujian'],
            'registrasi'      => $row['registrasi'],
            'status_kelulusan'=> $row['status_kelulusan'],
            'periode'         => $data->periode,
        ]);
    }

    public function rules(): array
    {
        return [
            // '*.nama_lengkap' => ['required'],
            // '*.prodi1'       => ['required'],
            // '*.prodi2'       => ['required'],
            // '*.prodi3'       => ['required'],
            // '*.prodi4'       => ['required'],
            // '*.prodi5'       => ['required'],
            // '*.virtual_account' => ['unique:ms_maba,virtual_account'],
            // '*.email' => ['unique:ms_maba,email']
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }
}
    