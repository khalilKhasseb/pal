<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
       $this->migrator->add('header_settings.top_header_enabled' , true);
    }
};
