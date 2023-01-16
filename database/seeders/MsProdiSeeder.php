<?php

namespace Database\Seeders;

use App\Models\ms_prodi;
use Illuminate\Database\Seeder;

class MsProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ms_prodi::truncate();

        $collections = [
            [
                'kode_prodi' => 21201,
                'nama_prodi' => 'Teknik Mesin',
                'singkatan' => 'TM'
            ],
            [
                'kode_prodi' => 26201,
                'nama_prodi' => 'Teknik Industri',
                'singkatan' => 'TI'
            ],
            [
                'kode_prodi' => 48201,
                'nama_prodi' => 'Farmasi',
                'singkatan' => 'FM'
            ],
            [
                'kode_prodi' => 55201,
                'nama_prodi' => 'Teknik Informatika',
                'singkatan' => 'IF'
            ],
            [
                'kode_prodi' => 57201,
                'nama_prodi' => 'Sistem Informasi',
                'singkatan' => 'SI'
            ],
            [
                'kode_prodi' => 61201,
                'nama_prodi' => 'Manajemen',
                'singkatan' => 'MN'
            ],
            [
                'kode_prodi' => 62201,
                'nama_prodi' => 'Akuntansi',
                'singkatan' => 'AK'
            ],
            [
                'kode_prodi' => 73201,
                'nama_prodi' => 'Psikologi',
                'singkatan' => 'PS'
            ],
            [
                'kode_prodi' => 74201,
                'nama_prodi' => 'Ilmu Hukum',
                'singkatan' => 'HK'
            ],
            [
                'kode_prodi' => 86206,
                'nama_prodi' => 'Pendidikan Guru Sekolah Dasar',
                'singkatan' => 'SD'
            ],
            [
                'kode_prodi' => 86230,
                'nama_prodi' => 'Pendidikan Agama Islam',
                'singkatan' => 'PI'
            ],
            [
                'kode_prodi' => 87205,
                'nama_prodi' => 'Pend. Pancasila & Kewarganegaraan',
                'singkatan' => 'PK'
            ],
        ];

        foreach($collections as $item){
            ms_prodi::create($item);
        }
    }
}
