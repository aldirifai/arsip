<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'nama',
        'nomor_ijazah',
        'tanggal_legalisir',
        'nama_sekolah',
        'file_arsip',
        'id_periode',
        'id_jenjang',
    ];

    public $timestamps = false;

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id');
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_periode', 'id');
    }
}
