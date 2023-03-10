<?php

namespace App\Http\Controllers;

use App\Http\Resources\DefaultCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BaseController extends Controller
{
    protected $service;
    protected $jsonResource;

    public function index(Request $request): ResourceCollection
    {
        $resources = $this->service->index($request->all());

        return new DefaultCollection($this->jsonResource, $resources);
    }

    public function show(int $id): JsonResponse
    {
        $resource = $this->service->show($id);

        if (!$resource) {
            return $this->notFoundError(['message' => __('messages.api.error.not.found')]);
        }

        return new $this->jsonResource($resource);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $stored = $this->service->store($request->all());
        } catch (ValidationException $e) {
            return $this->badRequestError(['errors' => $e->errors()]);
        } catch (\Exception $e) {
            return $this->genericError(['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }

        return $this->created([
            'data' => $this->jsonResource::make($stored),
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $resource = $this->service->show($id);

        if (!$resource) {
            return $this->_notFoundError(['message' => __('messages.api.error.not.found')]);
        }

        try {
            $updated = $this->service->update($resource, $request->all());
        } catch (ValidationException $e) {
            return $this->badRequestError(['errors' => $e->errors()]);
        } catch (\Exception $e) {
            return $this->genericError(['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }

        return $this->success([
            'data' => $this->jsonResource::make($updated),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $resource = $this->service->show($id);

        if (!$resource) {
            return $this->notFoundError(['message' => __('messages.api.error.not.found')]);
        }

        try {
            $this->service->destroy($resource);
        } catch (\Exception $e) {
            return $this->genericError(['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }

        return $this->noContent();
    }

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
