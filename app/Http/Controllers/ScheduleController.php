<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends BaseController
{
    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->jsonResource = CityResource::class;
    }
}
