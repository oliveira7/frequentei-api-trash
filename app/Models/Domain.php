<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'domains';

    protected $fillable = [
        'teacher_id',
        'name',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
