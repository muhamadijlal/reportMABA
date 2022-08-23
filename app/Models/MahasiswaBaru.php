<?php

namespace App\Models;

use App\Http\Controllers\ReportController;
use App\Models\ReportMahasiswaBaru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBaru extends Model
{
    use HasFactory;

    protected $table = 'ms_maba';    
    protected $guarded = ["id"];

    public function Report_maba(){
        return $this->belongsTo(ReportMahasiswaBaru::class, 'id_report_maba');
    }
}
