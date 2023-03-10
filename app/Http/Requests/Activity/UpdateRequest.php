<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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
