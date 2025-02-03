<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use  App\Models\User as Model;
use Filament\Panel;
//use Filament\Models\Contracts\FilamentUser;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Database\Eloquent\Relations\HasOne

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemUser extends Model implements FilamentUser
{
    protected $table = "system_users";


    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

   

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function googleTokens()
    {
        return $this->hasMany(Token::class);
    }



    public function hasGoogleTokens(): bool
    {
        return !is_null($this->googleTokens) && $this->googleTokens->count() > 0;
    }

    // public function

    public function getActiveToken()
    {
        return $this->tokens()->active()->first();
    }
}
