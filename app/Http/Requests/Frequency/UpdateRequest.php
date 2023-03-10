<?php

namespace App\Http\Requests\Frequency;

use App\Http\Requests\BaseRequests\Request;

class UpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'user_id' => 'proibited',
            'teacher_id' => 'proibited',
            'activity_id' => 'proibited',
            'schedule_id' => 'proibited',
            'present' => 'sometimes|boolean',
        ];
    }
}
