<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RincianIndukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'nama_item'     => $this->nama_item,
            'satuan'        => $this->satuan,
            'harga_satuan'  => $this->harga_satuan
        ];
    }
}
