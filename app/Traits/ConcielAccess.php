<?php
namespace App\Traits;
trait ConcielAccess {
    public static function canAccess() : bool {
                return filament()->getCurrentPanel()->getId() === 'admin';

    }
}