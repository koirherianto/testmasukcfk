<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPerintahLembur extends Model
{
    use HasFactory;    
    public $table = 'surat_perintah_lemburs';

    public $fillable = [
        'karyawan_id',
        'mulai',
        'selesai',
        'total_jam_lembur'
    ];

    protected $casts = [
        'mulai' => 'datetime',
        'selesai' => 'datetime'
    ];

    public static array $rules = [
        'karyawan_id' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
        'total_jam_lembur' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function karyawan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Karyawan::class, 'karyawan_id');
    }

    public function splStatuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\SplStatus::class, 'surat_perintah_lembur_id');
    }
}
