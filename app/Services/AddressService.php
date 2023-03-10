<?php

namespace App\Services;

use App\Repositories\AddressRepository;

class AddressService extends BaseService
{
    protected $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }
}
