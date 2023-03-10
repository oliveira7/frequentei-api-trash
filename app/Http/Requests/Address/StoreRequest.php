<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequests\Request;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'street' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'number' => 'required|integer',
            'complement' => 'nullable|string|max:255',
        ];
    }
}
