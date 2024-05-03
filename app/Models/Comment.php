<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'comment', 'website', 'email'];
    public function commantabel(): MorphTo
    {
        return $this->morphTo();
    }
}
