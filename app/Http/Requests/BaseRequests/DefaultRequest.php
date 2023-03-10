<?php

namespace App\Http\Requests\BaseRequests;

/**
 * Class needed for dependency injection of a FormRequest implementing the RequestInterface.
 */
class DefaultRequest extends Request
{
    /**
     * Validation Rules that works for all kind of profiles.
     */
    public function rules(): array
    {
        return [];
    }
}
