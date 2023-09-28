<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'point_id',
        'invoice_code',
        'date',
        'amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'point_id' => 'integer',
        'invoice_code' => 'integer',
        'date' => 'date',
        'amount' => 'double',
    ];

    public function point(): BelongsTo
    {
        return $this->belongsTo(Point::class);
    }
}
