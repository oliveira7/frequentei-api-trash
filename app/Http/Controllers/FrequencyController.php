<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use Illuminate\Http\Request;

class FrequencyController extends BaseController
{
    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->jsonResource = CityResource::class;
    }
}
