<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frequency extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'frequencies';

    protected $fillable = [
        'user_id',
        'teacher_id',
        'activity_id',
        'schedule_id',
        'present',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
