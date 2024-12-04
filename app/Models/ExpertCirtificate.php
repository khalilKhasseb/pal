<?php

namespace App\Models;

use Google\Service\AdExperienceReport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertCirtificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'expert_id',
        'certificate_name',
        'certifying_authority',
        'authenticate_certificate_url',
        'attachment_certification',
        'certification_experience',
        'year_of_certification'
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class, 'expert_id');
    }
}
