<?php

namespace App\Http\Requests\Activity;

use App\Http\Requests\BaseRequests\Request;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'domain_id' => 'required|integer|exists:domains,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }
}
