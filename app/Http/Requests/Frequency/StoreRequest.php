<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\BaseRequests\Request;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'activity_id' => 'required|integer|exists:activities,id',
            'schedule_id' => 'required|integer|exists:schedules,id',
            'present' => 'required|boolean',
        ];
    }
}
