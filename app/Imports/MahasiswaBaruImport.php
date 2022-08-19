<?php

namespace App\Imports;

use App\Models\MahasiswaBaru;
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

        return new MahasiswaBaru([
            'virtual_account'=> $row['va'],
            'email'          => $row['email'],
            'no_hp'          => $row['nohp'],
            'no_hp_ayah'     => $row['nohp_ayah'],
            'no_hp_ibu'      => $row['nohp_ibu'],
            'nama'           => $row['nama'],
            'sekolah'        => $row['sekolah'],
            'gelombang'      => $row['gelombang'],
            'tahun_lulus'    => $row['tahun_lulus'],
            'pilihan_prodi'  => $row['pilihan_prodi_1'],
            'register'       => $row['register'],
            'ujian'          => $row['ujian'],
            'bayar'          => $row['bayar_1'],
            'upload'         => $row['upload'],
            'ukuran_baju'    => $row['ukuran_baju'],
            'ukuran_baju'    => $row['ukuran_baju'],
            // 'periode'        => Str::substr($row['va'], 0, 4),
            'periode'        => request('periode')
        ]);
    }

    public function rules(): array
    {
        return [
            '*.virtual_account' => ['unique:ms_maba,virtual_account'],
            '*.email' => ['unique:ms_maba,email']
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }
}
    