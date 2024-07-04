<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('content.c_about_ar' , '');
        $this->migrator->add('content.c_about_en' , '');
        $this->migrator->add('content.s_about_en' , '');
        $this->migrator->add('content.s_about_ar' , '');
        $this->migrator->add('content.news_ar' , '');
        $this->migrator->add('content.news_en' , '');
        $this->migrator->add('content.contact_ar' , '');
        $this->migrator->add('content.contact_en' , '');
        $this->migrator->add('content.donate_en' , '');
        $this->migrator->add('content.donate_ar' , '');
        $this->migrator->add('content.partners_en' , '');
        $this->migrator->add('content.partners_ar' , '');
    }
};
