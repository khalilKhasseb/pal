<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HomeSection extends Model
{
    use HasFactory;

    public function widget(): HasOne {
        return $this->hasOne(Widget::class);
    } 
}
