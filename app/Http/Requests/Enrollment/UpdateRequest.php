<?php

namespace App\Http\Requests\Enrollment;

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
            'activity_id' => 'sometimes|integer|exists:activities,id',
            'status' => 'sometimes|boolean|in:true,false',
            'registration_at' => 'sometimes|date|date_format:Y-m-d H:i:s',
        ];
    }
}
