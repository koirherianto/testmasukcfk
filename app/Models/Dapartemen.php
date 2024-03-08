<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Dapartemen extends Model
{
    use HasFactory;    public $table = 'dapartements';

    public $fillable = [
        'name',
        'detail'
    ];

    protected $casts = [
        'name' => 'string',
        'detail' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:100',
        'detail' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function karyawans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Karyawan::class, 'dapartement_id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class, 'users_has_dapartements');
    }
}
