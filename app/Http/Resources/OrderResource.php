<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class OrderResource extends JsonResource
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
            'buyer_id' => $this->buyer_id,
            'transaction_id' => $this->transaction_id,
            'status' => $this->confirmed_at ? 'Complete' : 'Pending',
            'nft' => new NftResource($this->nft)
        ];
    }
}
