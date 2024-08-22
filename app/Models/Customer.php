<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'telephone_number',
        'passport_code',
        'passport_image',
        'start_date',
        'end_date',
        'motorcycle_id',
        'rate_per_day',
        'total_price',
    ];

    protected $casts = [
        'telephone_number' => 'decimal:0',
        'passport_code' => 'decimal:0',
        'start_date' => 'date',
        'end_date' => 'date',
        'rate_per_day' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }
}