<?php

namespace App\Http\Requests\Domain;

use App\Http\Requests\BaseRequests\Request;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
