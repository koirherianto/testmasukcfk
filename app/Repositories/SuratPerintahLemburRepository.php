<?php

namespace App\Repositories;

use App\Models\SuratPerintahLembur;
use App\Repositories\BaseRepository;

class SuratPerintahLemburRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'karyawan_id',
        'mulai',
        'selesai',
        'total_jam_lembur'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SuratPerintahLembur::class;
    }
}
