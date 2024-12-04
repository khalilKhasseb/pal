<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Expert extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'experts';
    protected $fillable = [
        'sir_name_ar',
        'sir_name_en',
        'gender',
        'email',
        'mobile_number',
        'city_id',
        'governorate_id',
        'date_of_birth',
        'university',
        'ba_major',
        'graduation_year',
        'other_degrees',
        'first_name',
        'first_name_en',
        'experience',
        'attachment_personal_photo',
        'agreement_check',
    ];

    public function certificates()
    {
        return $this->hasMany(ExpertCirtificate::class, 'expert_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

}
