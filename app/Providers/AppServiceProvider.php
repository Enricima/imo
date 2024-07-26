<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Enregistrement de PHPMailer dans le conteneur de services
        $this->app->singleton(PHPMailer::class, function ($app) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mathis.enrici@gmail.com'; // Votre adresse e-mail Gmail
            $mail->Password = 'tahl yssl wlpb bctm'; // Votre mot de passe Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            
            return $mail;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
