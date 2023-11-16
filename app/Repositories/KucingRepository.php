<?php

namespace App\Repositories;

use App\Models\Kucing;
use App\Repositories\BaseRepository;

class KucingRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nama',
        'tanggal_lahir',
        'penjelasa',
        'is_boy'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Kucing::class;
    }
}
