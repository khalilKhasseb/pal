<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role_name'];

    public const ADMIN = 1;
    public const MANGER = 2;
    public const GUEST = 3;
    public const MEMBER = 4;
}
