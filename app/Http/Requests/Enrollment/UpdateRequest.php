<?php

namespace App\Http\Requests\Enrollment;

use App\Http\Requests\BaseRequests\Request;

class UpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'activity_id' => 'sometimes|integer|exists:activities,id',
            'status' => 'sometimes|boolean|in:true,false',
            'registration_at' => 'sometimes|date|date_format:Y-m-d H:i:s',
        ];
    }
}
