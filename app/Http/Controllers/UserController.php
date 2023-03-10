<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\{
    StoreRequest,
    UpdateRequest,
};
use App\Http\Resources\{
    UserResource,
    DefaultCollection,
};;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->jsonResource = UserResource::class;
    }

    public function index(Request $request): ResourceCollection
    {
        $resources = $this->service->index($request->all());

        return new DefaultCollection($this->jsonResource, $resources);
    }

    public function show(int $id): UserResource
    {
        $resource = $this->service->show($id);
        if (!$resource) {
            return $this->notFoundError(['message' => __('messages.api.error.not.found')]);
        }

        return new $this->jsonResource($resource);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->merge([
                'User_id' => auth()->user()->User->id,
            ])->all();

            $stored = $this->service->store($data);
        } catch (ValidationException $e) {
            return $this->badRequestError(['errors' => $e->errors()]);
        } catch (\Exception $e) {
            return $this->genericError(['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }

        return $this->created([
            'data' => $this->jsonResource::make($stored),
        ]);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
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
}
