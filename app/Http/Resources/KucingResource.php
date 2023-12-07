<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KucingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'penjelasa' => $this->penjelasa,
            'is_boy' => $this->is_boy,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
