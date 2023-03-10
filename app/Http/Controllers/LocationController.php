<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->jsonResource = CityResource::class;
    }
}
