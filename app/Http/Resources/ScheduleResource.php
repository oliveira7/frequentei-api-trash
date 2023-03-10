<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'activity_id' => (int) $this->activity_id,
            'day_of_the_week' => (string) $this->day_of_the_week,
            'time' => (string) $this->time,
            'created_at' => (string) $this->created_at->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => (string) $this->updated_at->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
