<?php

namespace App\Http\Requests\Enrollment;

use App\Http\Requests\BaseRequests\Request;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'activity_id' => 'required|integer|exists:activities,id',
            'status' => 'required|boolean',
            'registered_at' => 'required|date|date_format:Y-m-d H:i:s',
        ];
    }
}
