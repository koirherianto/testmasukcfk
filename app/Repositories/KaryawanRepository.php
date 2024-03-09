<?php

namespace App\Repositories;

use App\Models\Karyawan;
use App\Repositories\BaseRepository;

class KaryawanRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'dapartement_id',
        'name',
        'nik'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Karyawan::class;
    }
}
