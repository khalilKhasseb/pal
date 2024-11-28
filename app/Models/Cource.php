<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\CropPosition;
use App\Traits\PanelResource;
class Cource extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasTranslations;
    //   PanelResource;

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
        'scholership_link',
        'hours',
        'objective',
        'content',
        'google_form_id'
    ];

    protected $translatable = [
        'title',
        'location',
        'trainer',
        'target_audince',
        'partners',
        'objective',
        'content',
        'hours'
    ];

    public function google_form() : BelongsTo {
        return $this->BelongsTo(GoogleForm::class);
    }
    //

    public function form(): BelongsTo
    {
        return $this->belongsTo(GoogleForm::class, 'google_form_id', 'id');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media|null $media = null): void {

        $this->addMediaConversion('thumb-cropped')
        ->performOnCollections('thumbnail')
            ->crop(380, 300, CropPosition::Center);

        // $this->addMediaConversion('thumb-cropped-original')
        //     ->performOnCollections('posts')
        //     ->crop(380, 300, CropPosition::Center);
        $this->addMediaConversion('thumb-cropped-original')
            ->performOnCollections('cources')
            ->fit(Fit::Fill ,380, 300 , false , '#333');


}


}
