<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'karyawans';

    public $fillable = [
        'dapartement_id',
        'name',
        'nik'
    ];

    protected $casts = [
        'name' => 'string',
        'nik' => 'string'
    ];

    public static array $rules = [
        'dapartement_id' => 'required',
        'name' => 'required|string|max:100',
        'nik' => 'required|string|max:45|unique:karyawans,nik',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function dapartement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Dapartemen::class, 'dapartement_id');
    }

    public function suratPerintahLemburs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\SuratPerintahLembur::class, 'karyawan_id');
    }
}
