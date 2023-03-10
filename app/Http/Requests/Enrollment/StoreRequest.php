<?php

namespace App\Http\Requests\Enrollment;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
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
            'activity_id' => 'required|integer|exists:activities,id',
            'status' => 'required|boolean|in:true,false',
            'registration_at' => 'required|date|date_format:Y-m-d H:i:s',
        ];
    }
}
