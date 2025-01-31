<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'rfid_card_id',
        'access_granted',
        'vehicle_id',
        'time_in',
        'time_out',
        'entry_type',
        'access_status',
        'gate_id',
        'created_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'access_status' => 'boolean',
        'gate_id' => 'integer',
    ];

    /**
     * Get the user that owns the entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    public function gate()
//    {
//        return $this->belongsTo(Gate::class);
//    }

    public function rfidCard(): BelongsTo
    {
        return $this->belongsTo(RfidCard::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

}
