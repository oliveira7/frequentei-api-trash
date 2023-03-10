<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'domain_id' => 'required|integer|exists:domains,id',
            'location_id' => 'required|integer|exists:locations,id',
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'modality' => 'required|string|max:255',
            'class_size' => 'required|integer',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'description' => 'required|string',
        ];
    }
}
