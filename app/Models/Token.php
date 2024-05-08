<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    use HasFactory;
    protected $table = 'tokens';

    protected $fillable = ['account_email','token_type','scope','expires_in','access_token','refresh_token', 'code' , 'id_token' , 'created'];

    protected $hidden = ['id','created_at' ,'updated_at' ,'account_email'];


    public function system_user() : BelongsTo {
        return $this->belongsTo(SystemUser::class);
    }


    public function scopeActive(Builder $query) :void{
        $query->where('active' , 1);
    }

}
