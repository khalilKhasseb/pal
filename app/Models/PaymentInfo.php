<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentInfo extends Model
{
    use HasFactory;
    public $table = 'payments';
    protected $fillable = [
        'reference',
        'full_name',
        'email',
        'mobile',
        'address',
        'purpose',
        'classification',
        'amount',
        'contact_before_payment',
        'currency',
        'status',
        'api_response'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'contact_before_payment' => 'boolean',
        'amount' => 'decimal:2',
        'api_response' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the human-readable status.
     */
    // public function getStatusAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    public function getApiResponseForDisplayAttribute()
    {
        $apiResponse = $this->api_response;

        if (!is_array($apiResponse)) {
            return [];
        }

        // Flatten nested arrays
        $flattened = [];
        $this->flattenArray($apiResponse, $flattened);

        return $flattened;
    }

    /**
     * Recursive function to flatten nested arrays.
     */
    private function flattenArray(array $array, array &$result, string $prefix = '')
    {
        foreach ($array as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;

            // Translate the key
            $translatedKey = __("messages.api_response.{$fullKey}");


            if (is_array($value)) {
                $this->flattenArray($value, $result, $fullKey);
            } else {
                $result[$translatedKey] = is_null($value) ? '' : (string) $value; // Translate key and ensure value is string
            }
        }
    }

    public static function generateReference(): string
    {
        $prefix = 'PAY-';
        $datePart = date('Ymd');
        $allowedChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-='; // No lowercase for better readability

        do {
            $random = Str::random(6, $allowedChars);
            $reference = "{$prefix}{$datePart}-{$random}";
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }
}
