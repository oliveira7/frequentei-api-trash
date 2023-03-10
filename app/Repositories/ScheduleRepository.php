<?php

namespace App\Repositories;

class ScheduleRepository extends BaseRepository
{
    public function create(array $data)
    {
        [
            'activity_id' => $activity_id,
            'time' => $time,
            'day_of_the_week' => $day_of_the_week,
        ] = $data;

        $size = count($day_of_the_week);

        while ($size--) {
            $resource = $this->getModel();
            $resource->fill([
                'activity_id' => $activity_id,
                'day_of_the_week' => $day_of_the_week[$size],
                'time' => $time[$size],
            ]);
            $resource->save();
        }

        return $resource;
    }
}
