<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Links extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url', 'icon','color', 'linkable_type', 'linkable_id'];
    public function linkable() : MorphTo {
        return $this->morphTo();
    }
}
