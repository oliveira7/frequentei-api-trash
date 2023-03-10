<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'domain_id',
        'name',
        'description',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
