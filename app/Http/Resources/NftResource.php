<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

class NftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => Hashids::encode($this->id),
            'user_id' => $this->user_id,
            'token_id' => $this->token_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'supply' => $this->supply,
            'fil_address' => $this->file_address,
            'network' => $this->network,
            'asset' => Storage::disk('asset')->url($this->asset),
            'asset_type' => $this->asset_type
        ];
    }
}
