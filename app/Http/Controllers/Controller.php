<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as RouteController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class Controller extends RouteController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $service;
    protected string $jsonResource;

    protected function success(array $data): JsonResponse
    {
        $data = array_merge([
            'success' => true,
        ], $data);

        return response()->json($data, Response::HTTP_OK);
    }

    protected function created(array $data): JsonResponse
    {
        $data = array_merge([
            'success' => true,
        ], $data);

        return response()->json($data, Response::HTTP_CREATED);
    }

    protected function noContent(): JsonResponse
    {
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    protected function badRequestError(array $data): JsonResponse
    {
        $data = array_merge([
            'success' => false,
        ], $data);

        return response()->json($data, Response::HTTP_BAD_REQUEST);
    }

    protected function notFoundError(array $data): JsonResponse
    {
        $data = array_merge([
            'success' => false,
        ], $data);

        return response()->json($data, Response::HTTP_NOT_FOUND);
    }

    protected function genericError(array $data): JsonResponse
    {
        if (!config('app.debug')) {
            $data = ['message' => __('messages.')];
        }

        $data = array_merge([
            'success' => false,
        ], $data);

        return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function validationRequest(Request $request, array $rules, array $messages = [], array $customAttributes = []): array
    {
        $validator = \Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}

