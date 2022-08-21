<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBaru extends Model
{
    use HasFactory;

    protected $table = 'ms_maba';    
    protected $fillable = [
        'virtual_account',
        'email',
        'no_hp',
        'no_hp_ayah',
        'no_hp_ibu',
        'nama',
        'sekolah',
        'gelombang',
        'tahun_lulus',
        'pilihan_prodi',
        'register',
        'ujian',
        'bayar',
        'upload',
        'ukuran baju',
        'periode',
    ];
    // protected $guarded = ["id"];
}
