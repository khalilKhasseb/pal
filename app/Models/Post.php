<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Models\Post as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.system_users.database.model', config('auth.providers.system_users.model')), 'user_id', 'id');
    }

}
