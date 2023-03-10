<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'activities';

    protected $fillable = [
        'domain_id',
        'teacher_id',
        'location_id',
        'code',
        'name',
        'modality',
        'class_size',
        'start_at',
        'end_at',
        'description',
    ];

    protected $dates = [
        'start_at',
        'end_at',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
