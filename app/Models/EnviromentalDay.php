<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\PanelResource;
class EnviromentalDay extends Model
{
    use HasFactory , HasTranslations;

    protected $fillable = ['title', 'month', 'day'];

    public $translatable = ['title'];
}
