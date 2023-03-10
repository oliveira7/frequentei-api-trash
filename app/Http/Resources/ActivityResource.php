<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'teacher_id' => (int) $this->teacher_id,
            'location_id' => (int) $this->location_id,
            'code' => (string) $this->code,
            'name' => (string) $this->name,
            'modality' => (string) $this->modality,
            'class_size' => (int) $this->class_size,
            'start_at' => (string) $this->start_at,
            'end_at' => (string) $this->end_at,
            'description' => (string) $this->description,
            'created_at' => (string) $this->created_at->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => (string) $this->updated_at->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
