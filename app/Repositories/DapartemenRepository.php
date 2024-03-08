<?php

namespace App\Repositories;

use App\Models\Dapartemen;
use App\Repositories\BaseRepository;

class DapartemenRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'detail'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Dapartemen::class;
    }
}
