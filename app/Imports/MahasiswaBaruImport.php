<?php

namespace App\Imports;

use Throwable;
use App\Models\MahasiswaBaru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

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
        return new MahasiswaBaru([
            'nama'          => $row['nama'],
            'nim'           => $row['nim'],
            'program_studi' => $row['program_studi'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nim' => ['unique:ms_maba,nim']
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }

    // public function onFailure(Failure ...$failure)
    // {
    // }
}
