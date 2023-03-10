<?php

namespace App\Services;

use App\Repositories\FrequencyRepository;

class FrequencyService extends BaseService
{
    protected $repository;

    public function __construct(FrequencyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store($data)
    {
        $data['teacher_id'] = auth()->user()->teacher->id;
        return parent::store($data);
    }
}
