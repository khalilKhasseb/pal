<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'mid_name',
        'last_name',
        'email',
        'phone',
        'amount',
        'currency',
        'payment_type',
        'payment_purpose',
        'órder_id',
        'response_time',
        'contact_before',
        'payment_details'
    ];

    protected $casts = [
        'contact_before' => "boolean"
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::of($value)->padLeft(12,"0"),
        );
    }
}
