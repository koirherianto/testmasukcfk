<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kucing extends Model
{
    use HasFactory;    public $table = 'kucings';

    public $fillable = [
        'nama',
        'tanggal_lahir',
        'penjelasa',
        'is_boy'
    ];

    protected $casts = [
        'nama' => 'string',
        'tanggal_lahir' => 'date',
        'penjelasa' => 'string',
        'is_boy' => 'boolean'
    ];

    public static array $rules = [
        'nama' => 'required|string|max:124',
        'tanggal_lahir' => 'required',
        'penjelasa' => 'required|string|max:65535',
        'is_boy' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
