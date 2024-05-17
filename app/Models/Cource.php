<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Cource extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia , HasTranslations;

    protected $fillable = [
        'title',
        'location',
        'trainer',
        'target_audince',
        'partners',
        'start_date',
        'end_date',
        'fees',
        'scholership',
        'hours',
        'objective',
        'goles',
        'summary',
        'google_form_id'
    ];

    protected $translatable = [
        'title',
        'location',
        'trainer',
        'target_audince',
        'partners',
        'objective',
        'goles',
    ];
    public function google_form() : BelongsTo {
        return $this->BelongsTo(GoogleForm::class);
    }
}
