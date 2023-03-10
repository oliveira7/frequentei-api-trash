<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Services\AddressService;

class AddressController extends Controller
{
    public function __construct(AddressService $service)
    {
        $this->service = $service;
        $this->jsonResource = AddressResource::class;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
