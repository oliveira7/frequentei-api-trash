<?php

namespace App\Http\Controllers;

class TeacherController extends Controller
{
    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->jsonResource = CityResource::class;
    }
}
