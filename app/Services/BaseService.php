<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BaseService
{
    protected $repository;

    public function index(array $requestData = [], ?Builder $query = null)
    {
        $query ??= $this->repository->query();

        $paginationEnabled = (bool) Arr::get($requestData, 'pagination', 1);
        $strQuery = Arr::get($requestData, 'query', '');
        $strQueryIn = array_filter(explode(',', Arr::get($requestData, 'query_in', '')));
        $sortField = Arr::get($requestData, 'sort_field', null);
        $sortDirection = Arr::get($requestData, 'sort_direction', 'ASC');
        $sort = Arr::get($requestData, 'sort', null);
        $perPage = (int) Arr::get($requestData, 'per_page', 15);
        $searchableFields = $this->repository->getModel()->searchable ?? [];
        $allowedQueryParams = $this->repository->getModel()->allowedQueryParams ?? [];

        foreach ($allowedQueryParams as $field) {
            $value = Arr::get($requestData, $field, '');

            if (mb_strlen($value) > 0) {
                $query->where($field, '=', $value);
            }
        }

        if (\count($strQueryIn) > 0) {
            $query->where(function ($subquery) use ($searchableFields, $strQueryIn): void {
                foreach ($searchableFields as $field) {
                    $subquery->orWhereIn($field, $strQueryIn);
                }
            });
        }

        if (mb_strlen($strQuery) > 0) {
            $query->where(function ($subquery) use ($searchableFields, $strQuery): void {
                $searchString = str_replace(' ', '%', $strQuery);
                foreach ($searchableFields as $field) {
                    $subquery->orWhere("$field", 'LIKE', "%{$searchString}%");
                }
            });
        }

        if ($sortField) {
            $sort .= sprintf(',%s:%s', $sortField, $sortDirection);
        }

        // workaround for sorting while not using BaseService
        $this->sortingFields($query, $sort);

        $this->paginationSetting($perPage, $paginationEnabled);

        return $paginationEnabled ? $query->paginate($perPage) : $query->get();
    }

    public function show(int $id)
    {
        return $this->repository->findBy('id', $id);
    }

    public function store(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($resource, $data)
    {
        $this->repository->update($data, $resource->id);

        return $this->show($resource->id);
    }

    public function destroy($resource)
    {
        return $this->repository->delete($resource->id);
    }

    protected function paginationSetting(int &$perPage, bool &$pagination): void
    {
        // Remove values negative
        if ($perPage <= 0) {
            $perPage = static::$DEFAULT_PER_PAGE;
        }

        // Validates max items per page
        if ($perPage > static::$MAX_PER_PAGE) {
            $perPage = static::$MAX_PER_PAGE;
        }

        // Validates if pagination can be false
        $pagination = $this->canDisablePagination ? filter_var($pagination, \FILTER_VALIDATE_BOOLEAN) : true;
    }

    protected function sortingFields(Builder &$query, ?string $sortField): void
    {
        $sortFields = Str::of($sortField)->split('/[\s,]+/')->filter();
        if (!empty($sortFields)) {
            foreach ($sortFields as $sortItem) {
                [$column, $direction] = explode(':', $sortItem . ':');
                $direction = \in_array(mb_strtoupper($direction), ['ASC', 'DESC']) ? $direction : 'ASC';
                $query->orderBy($column, $direction);
            }
        }
    }
}
