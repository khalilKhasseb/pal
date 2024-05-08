<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class GoogleAcount extends Model
{
    use HasFactory;
    protected $filables = [''];


    public function user(){
        return $this->belongsTo(SystemUser::class);
    }
}
