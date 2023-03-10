<?php

namespace App\Services;

use App\Repositories\DomainRepository;
use App\Repositories\TeacherRepository;
use App\Enums\TeacherEnum;

class DomainService extends BaseService
{
    protected $repository;
    protected $teacherRepository;

    public function __construct(DomainRepository $repository, TeacherRepository $teacherRepository)
    {
        $this->repository = $repository;
        $this->teacherRepository = $teacherRepository;
    }

    public function store(array $data)
    {
        if(!is_null(auth()->user()->teacher)){
            $data = array_merge($data, ['teacher_id' => auth()->user()->teacher->id]);

            return parent::store($data);
        }

        $teacher = $this->teacherRepository->create([
            'user_id' => auth()->user()->id,
            'type' => TeacherEnum::TYPE_MAIN,
        ]);

        $data = array_merge($data, ['teacher_id' => $teacher->id]);

        return $this->repository->create($data);
    }


}
