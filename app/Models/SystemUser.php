<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use  App\Models\User as Model;
use Filament\Panel;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemUser extends Model implements FilamentUser
{
    protected $table = "system_users";


    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function posts() : HasMany {
        return $this->hasMany(Post::class , 'user_id' , 'id');
    }
}
