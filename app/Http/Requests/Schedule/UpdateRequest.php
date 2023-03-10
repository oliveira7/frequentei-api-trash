<?php

namespace App\Http\Requests\Schedule;

use App\Http\Requests\BaseRequests\Request;
use Illuminate\Validation\Rule;
use App\Enums\WeekEnum;

class UpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'activity_id' => 'prohibited',
            'day_of_the_week' => [
                'sometimes',
                'string',
                Rule::in(WeekEnum::getTypes()),
            ],
            'time' => 'sometimes|string|date_format:H:i',
        ];
    }
}
