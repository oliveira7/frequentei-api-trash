<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'registration_code' => !is_null($this->registration_code) ?
                (string) $this->registration_code :
                null,
            'bithdate' => !is_null($this->bithdate) ?
                (string) $this->bithdate->format('Y-m-d\TH:i:s\Z') :
                null,
            'phone' => !is_null($this->phone) ?
                (string) $this->phone :
                null,
            'created_at' => (string) $this->created_at->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => (string) $this->updated_at->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
