<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('paymentGateWay.version', null);

        $this->migrator->add('paymentGateWay.merchant_id', null);
        $this->migrator->add('paymentGateWay.merchant_password', null);
        $this->migrator->add('paymentGateWay.acquire_id', null);

        $this->migrator->add('paymentGateWay.callback_url', null);
        $this->migrator->add('paymentGateWay.autorize_url', null);

        $this->migrator->add('paymentGateWay.currency_code', 840);
        $this->migrator->add('paymentGateWay.currency_exp', 0);
        $this->migrator->add('paymentGateWay.capture_flag', 'M');

        $this->migrator->add('paymentGateWay.signture_method', 'SHA1');
    }
};
