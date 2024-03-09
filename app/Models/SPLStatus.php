<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SPLStatus extends Model
{
    use HasFactory;    
    public $table = 'spl_status';

    public $fillable = [
        'approved_by',
        'surat_perintah_lembur_id',
        'status',
        'message'
    ];

    
    protected $casts = [
        'status' => 'string', //draft,menunggu,revisi,disetujui,ditolak
        'message' => 'string'
    ];

    public static array $rules = [
        'approved_by' => 'required',
        'surat_perintah_lembur_id' => 'required',
        'status' => 'required|string',
        'message' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function approvedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function suratPerintahLembur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\SuratPerintahLembur::class, 'surat_perintah_lembur_id');
    }
}
