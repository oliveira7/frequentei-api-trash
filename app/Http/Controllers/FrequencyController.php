<?php

namespace App\Http\Controllers;

class FrequencyController extends BaseController
{
    public function __construct(FrequencyService $service)
    {
        $this->service = $service;
        $this->jsonResource = FrequencyResource::class;
    }
}
