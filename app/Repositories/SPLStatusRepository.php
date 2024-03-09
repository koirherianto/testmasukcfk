<?php

namespace App\Repositories;

use App\Models\SPLStatus;
use App\Repositories\BaseRepository;

class SPLStatusRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'approved_by',
        'surat_perintah_lembur_id',
        'status',
        'message'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SPLStatus::class;
    }
}
