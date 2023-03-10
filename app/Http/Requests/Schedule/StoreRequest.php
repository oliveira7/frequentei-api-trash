<?php

namespace App\Http\Requests\Schedule;

use App\Http\Requests\BaseRequests\Request;
use Illuminate\Validation\Rule;
use App\Enums\WeekEnum;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'activity_id' => 'required|integer|exists:activities,id',
            'day_of_the_week' => 'required|array',
            'day_of_the_week.*' => [
                'required',
                'string',
                Rule::in(WeekEnum::getTypes()),
            ],
            'time' => 'required|array',
            'time.*' => 'required|string|date_format:H:i',
        ];
    }
}
