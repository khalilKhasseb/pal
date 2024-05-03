<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = 'tokens';

    protected $fillable = ['account_email','token_type','scope','expires_in','access_token','refresh_token', 'code' , 'id_token' , 'created'];

    protected $hidden = ['id','created_at' ,'updated_at' ,'account_email'];


}
