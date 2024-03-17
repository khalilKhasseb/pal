<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('generalSetting.site_name' , 'Palgpc');
        $this->migrator->add('generalSetting.site_description' , 'Site description');
        $this->migrator->add('generalSetting.site_logo' , null);
    }
};
