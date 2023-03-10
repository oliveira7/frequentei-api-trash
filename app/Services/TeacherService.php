<?php

namespace App\Services;

use App\Repositories\TeacherRepository;

class TeacherService extends BaseService
{
    protected $repository;

    public function __construct(TeacherRepository $repository)
    {
        $this->repository = $repository;
    }


}
