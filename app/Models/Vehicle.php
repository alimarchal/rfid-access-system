<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'vehicle_no',
        'make',
        'model',
        'manufacture_year',
        'color',
        'additional_details',
    ];

    /**
     * Get the user that owns the vehicle.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
