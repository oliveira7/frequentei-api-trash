<?php

namespace App\Services;

use App\Repositories\ScheduleRepository;

class ScheduleService extends BaseService
{
    protected $repository;

    public function __construct(ScheduleRepository $repository)
    {
        $this->repository = $repository;
    }
}
