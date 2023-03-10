<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'user_id' => (int) $this->user_id,
            'street' => (string) $this->street,
            'zip_code' => (string) $this->zip_code,
            'city' => (string) $this->city,
            'neighborhood' => (string) $this->neighborhood,
            'number' => (int) $this->number,
            'complement' => (string) $this->complement,
            'created_at' => (string) $this->created_at->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => (string) $this->updated_at->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
