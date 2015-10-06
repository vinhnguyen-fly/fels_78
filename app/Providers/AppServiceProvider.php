<?php

namespace FELS\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureAppEnvironments();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUserMailer();
    }

    /**
     * Set different configurations for different application environments.
     */
    protected function configureAppEnvironments()
    {
        switch ($this->app->environment()) {
            case 'production':
                break;
            case 'local':
                $this->logDatabaseQueries();
                $this->configureMailtrap();
                break;
            case 'testing':
                config(['database.default' => 'sqlite']);
                break;
        }
    }

    /**
     * Log database queries for local development.
     */
    protected function logDatabaseQueries()
    {
        $logger = $this->app->make('log');
        $this->app->make('db')->listen(function ($sql, $bindings, $time) use ($logger) {
            $logger->info($time);
            $logger->info($sql);
            $logger->info($bindings);
        });
    }

    /**
     * Configure Mailtrap for testing emails sent from application.
     */
    protected function configureMailtrap()
    {
        config(['mail.driver' => 'smtp']);
        config(['mail.host' => 'mailtrap.io']);
        config(['mail.port' => '2525']);
        config(['mail.username' => env('MAILTRAP_USERNAME')]);
        config(['mail.password' => env('MAILTRAP_PASSWORD')]);
    }

    /**
     * Register mailer interfaces.
     */
    protected function registerUserMailer()
    {
        $this->app->singleton(
            \FELS\Core\Mailer\Contracts\UserMailerInterface::class,
            \FELS\Core\Mailer\UserMailer::class
        );
    }
}
