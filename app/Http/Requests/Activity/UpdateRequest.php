<?php

namespace App\Http\Requests\Activity;

use App\Http\Requests\BaseRequests\Request;

class UpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'location_id' => 'sometimes|integer|exists:locations,id',
            'code' => 'sometimes|string|max:255',
            'name' => 'sometimes|string|max:255',
            'modality' => 'sometimes|string|max:255',
            'class_size' => 'sometimes|integer',
            'start_at' => 'sometimes|date',
            'end_at' => 'sometimes|date',
            'description' => 'sometimes|string',
        ];
    }
}
