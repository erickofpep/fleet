<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    use HasFactory;

/**
 * Get the driver that owns the bid.
 */
/*
public function driver(): BelongsTo
{
    return $this->belongsTo(Drivers::class, 'driver_id');
}
*/

}
