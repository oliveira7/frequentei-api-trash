<?php

namespace App\Http\Requests\BaseRequests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

abstract class FormRequest extends Request implements RequestInterface
{
    protected Container $app;

    protected Validator $validator;

    abstract public function rules(): array;

    public function validated(): array
    {
        return $this->validator->validated();
    }

    public function validate(): void
    {
        if ($this->authorize() === false) {
            $this->failedAuthorization();
        }

        $this->validator = $this->app->make('validator')
            ->make($this->all(), $this->rules(), $this->messages(), $this->attributes());

        if ($this->validator->fails()) {
            $this->validationFailed();
        }

        $this->validationPassed();
    }

    public function setContainer(Container $app): void
    {
        $this->app = $app;
    }

    protected function errorMessage(): string
    {
        return 'The given data was invalid.';
    }

    protected function statusCode(): int
    {
        return 422;
    }

    protected function errorResponse(): JsonResponse
    {
        return response()->json([
            'message' => $this->errorMessage(),
            'errors' => $this->validator->errors()->messages(),
        ], $this->statusCode());
    }

    protected function failedAuthorization(): void
    {
        throw new AuthorizationException();
    }

    protected function validationFailed(): void
    {
        throw new ValidationException($this->validator, $this->errorResponse());
    }

    protected function validationPassed(): void
    {
    }

    protected function authorize(): bool
    {
        return true;
    }

    protected function messages(): array
    {
        return [];
    }

    protected function attributes(): array
    {
        return [];
    }
}
