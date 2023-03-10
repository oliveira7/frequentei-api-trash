<?php

namespace App\Services;

use App\Repositories\ActivityRepository;

class ActivityService extends BaseService
{
    protected $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }
}
