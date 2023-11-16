<?php

namespace App\Repositories;

use App\Models\Coy;
use App\Repositories\BaseRepository;

class CoyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nama',
        'tanggal_lahir',
        'tinggi',
        'penjelasan'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Coy::class;
    }
}
