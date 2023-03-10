<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'enrollments';

    protected $fillable = [
        'activity_id',
        'status',
        'registration_at',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
