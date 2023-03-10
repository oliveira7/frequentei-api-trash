<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends BaseController
{
    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->jsonResource = CityResource::class;
    }
}
