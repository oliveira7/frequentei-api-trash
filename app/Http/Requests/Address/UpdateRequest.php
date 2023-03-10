<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequests\Request;

class UpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'street' => 'sometimes|string|max:255',
            'zip_code' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'neighborhood' => 'sometimes|string|max:255',
            'number' => 'sometimes|integer',
            'complement' => 'nullable|string|max:255',
        ];
    }
}
