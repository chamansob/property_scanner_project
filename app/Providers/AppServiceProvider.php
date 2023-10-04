<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SmtpSetting;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (Schema::hasTable('site_settings')) {
            $site_settings = SiteSetting::first();
            if ($site_settings) {
                $data = $site_settings->app_name;                
               
                Config(['app.name' => $data]);
            }
        } // End If 
        if (Schema::hasTable('smtp_settings')) {

            $smtpsetting = SmtpSetting::first();
            if ($smtpsetting) {
                $data = [

                    'driver' => $smtpsetting->mailer,
                    'host' => $smtpsetting->host,
                    'port' => $smtpsetting->port,
                    'username' => $smtpsetting->username,
                    'password' => $smtpsetting->password,
                    'encryption' => $smtpsetting->encryption,
                    'from' => [
                        'address' => $smtpsetting->from_address,
                        'name' => $smtpsetting->from_name
                    ]
                ];
                config(['app.mail' => $data]);
                
            }
        } // End If 
    }
}