<?php

namespace App\Services;

use App\Repositories\DomainRepository;

class DomainService extends BaseService
{
    protected $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }
}
