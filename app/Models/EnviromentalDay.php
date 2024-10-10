<?php

namespace App\Models;

// use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;
use App\Traits\PanelResource;
class EnviromentalDay extends Model
{
    use HasFactory , HasTranslations;

    protected $fillable = ['title', 'month', 'day'];

    public $translatable = ['title'];

    protected function completeDate() : Attribute {

        return Attribute::make(get: function ($value, $attributes) {
            $month = ucfirst($attributes['month']);
            $day   = $attributes['day'];
            $year  = Carbon::now()->year;
            $date = "{$month} {$day} ,{$year}";
            return Carbon::parse($date)->toDateString();
        });
    }

    public function isThisYear() {
        return Carbon::parse($this->completeDate)->isSameDay(Carbon::now()->format('Y-m-d'));
    }
}
