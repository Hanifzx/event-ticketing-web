<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quota',
        'max_purchase_per_user',
        'sale_start_date', 
        'sale_end_date', 
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_start_date' => 'datetime',
            'sale_end_date' => 'datetime',
        ];
    }

    /**
     * Relasi ke event yang memiliki tiket ini
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relasi ke semua booking yang menggunakan tiket ini
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
