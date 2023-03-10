<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends BaseController
{
    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->jsonResource = CityResource::class;
    }
}
