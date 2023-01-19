<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MahasiswaBaru;

class ReportMahasiswaBaru extends Model
{
    use HasFactory;

    protected $table = 'report_maba';
    protected $guarded = ['id'];
    

    protected function Ms_maba(){
        return $this->hasMany(MahasiswaBaru::class, 'id_report_maba');
    }
}

