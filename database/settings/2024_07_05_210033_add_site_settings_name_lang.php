<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('generalSetting.ar_site_name', 'المجلس الفلسطيني للابنية الخضراء');
        $this->migrator->add('generalSetting.ar_site_description', 'المجلس الفلسطيني للأبنية الخضراء هو مؤسسة أهلية غير حكومية وغير ربحية تأسست منتصف العام 2011، وهو جزء من المجلس العالمي للأبنية الخضراء وشبكة مجالس الشرق الأوسط وشمال أفريقيا MENA.');
    }
};
