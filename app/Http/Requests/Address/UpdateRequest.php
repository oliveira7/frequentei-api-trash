<?php

namespace App\Http\Requests\Address;

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
            'street' => 'sometimes|string|max:255',
            'zip_code' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'neighborhood' => 'sometimes|string|max:255',
            'number' => 'sometimes|integer',
            'complement' => 'nullable|string|max:255',
        ];
    }
}
