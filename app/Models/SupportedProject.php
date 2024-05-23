<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class SupportedProject extends Model
{
    use HasFactory,HasTranslations;
    protected $fillable = ['name'];
    public $translatable = ['name'];


    public function supporters():BelongsToMany {
        return $this->belongsToMany(Supporter::class, 'supporters_supported_projects', 'supported_project_id', 'supporter_id');
    }

}
