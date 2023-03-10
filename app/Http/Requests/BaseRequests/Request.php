<?php

namespace App\Http\Requests\BaseRequests;

use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest implements RequestInterface
{
    public function validate(): void
    {
        if ($this->authorize() === false) {
            $this->failedAuthorization();
        }

        $rules = $this->rules();

        $this->validator = $this->app->make('validator')
            ->make($this->all(), $rules, $this->messages(), $this->attributes());

        if ($this->validator->fails()) {
            $this->validationFailed();
        }

        $this->validationPassed();
    }

    protected function errorResponse(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $this->validator->errors()->messages(),
        ], $this->statusCode());
    }
}
