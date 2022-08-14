<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBaru extends Model
{
    use HasFactory;

    protected $table = 'ms_maba';
    // protected $fillable = ['nama', 'nim', 'program_studi'];
    protected $guarded = ["id"];
}
