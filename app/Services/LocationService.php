<?php

namespace App\Services;

use App\Repositories\LocationRepository;

class LocationService extends BaseService
{
    protected $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }
}
