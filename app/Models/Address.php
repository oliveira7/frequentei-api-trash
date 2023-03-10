<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'adresses';

    protected $fillable = [
        'user_id',
        'street',
        'zip_code',
        'city',
        'neighborhood',
        'number',
        'complement',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
