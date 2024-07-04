<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
       $this->migrator->add('content.c_about_img' , null);
       $this->migrator->add('content.s_about_img' , null);
       $this->migrator->add('generalSetting.sommod_logo' , null);
    }
};
