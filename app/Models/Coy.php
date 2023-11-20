<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coy extends Model
{
    public $table = 'coys';

    public $fillable = [
        'nama',
        'tanggal_lahir',
        'tinggi',
        'penjelasan'
    ];

    protected $casts = [
        'nama' => 'string',
        'tanggal_lahir' => 'date',
        'penjelasan' => 'string'
    ];

    public static array $rules = [
        'nama' => 'required|string|max:11',
        'tanggal_lahir' => 'required',
        'tinggi' => 'required|min:10',
        'penjelasan' => 'required|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
