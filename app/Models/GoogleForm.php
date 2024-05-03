<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleForm extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'google_file_id',
        'type',
        'google_mimeType',
        'web_view_link',
        'questions'
    ];
}
