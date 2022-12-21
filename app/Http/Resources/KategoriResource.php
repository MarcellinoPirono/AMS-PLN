<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KategoriResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $khs_id = '';

        return [
            'id'                => $this->id,
            'nama_kategori'     => $this->nama_kategori,
            'khs_id'     => $khs_id,
        ];    
    }
}
