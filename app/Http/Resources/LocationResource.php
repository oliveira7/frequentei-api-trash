<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'domain_id' => (int) $this->domain_id,
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'created_at' => (string) $this->created_at->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => (string) $this->updated_at->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
