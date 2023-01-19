<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ms_prodi extends Model
{
    protected $table = 'ms_prodi';
    protected $guarded  = ['id'];

    protected function maba(){
        return $this->hasMany(MahasiswaBaru::class, 'prodi1');
    }
}
