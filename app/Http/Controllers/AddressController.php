<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Services\AddressService;

class AddressController extends BaseController
{
    public function __construct(AddressService $service)
    {
        $this->service = $service;
        $this->jsonResource = AddressResource::class;
    }
}
