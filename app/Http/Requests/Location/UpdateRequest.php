<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\BaseRequests\Request;

class UpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'domain_id' => 'sometimes|integer|exists:domains,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
        ];
    }
}
