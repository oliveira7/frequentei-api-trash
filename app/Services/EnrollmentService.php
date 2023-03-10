<?php

namespace App\Services;

use App\Repositories\EnrollmentRepository;

class EnrollmentService extends BaseService
{
    protected $repository;

    public function __construct(EnrollmentRepository $repository)
    {
        $this->repository = $repository;
    }
}
