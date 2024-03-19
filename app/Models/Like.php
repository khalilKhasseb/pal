<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Like extends Model
{
    use HasFactory;
    protected $table  = 'likes';

    protected $fillable = [
        'post_id',
        'ip'
    ];

    public static function check_like_for_address(string $address)
    {
        dd(self::where('ip', $address)->fi);
    }
}
