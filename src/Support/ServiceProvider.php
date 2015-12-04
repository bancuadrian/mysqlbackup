<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 10:23 PM
 */

namespace BancuAdrian\MysqlBackup\Support;


use BancuAdrian\MysqlBackup\BackupManager;
use BancuAdrian\MysqlBackup\Dumpers\SimpleDumper;
use BancuAdrian\MysqlBackup\Persistence\FilePersistence;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the service provider for Laravel 5
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'mysqlbackup'
        );

        $this->app->singleton('mysql.backup.manager', function ($app) {
            $dumper = new SimpleDumper(
                config('mysqlbackup.usr'),
                config('mysqlbackup.pwd'))
            ;
            $persistence = new FilePersistence(config('mysqlbackup.absolute_path'));

            $backupManager = new BackupManager($dumper, $persistence);
            if(count(config('mysqlbackup.databases')))
            {
                $backupManager->setDatabases(config('mysqlbackup.databases'));
            }
            return $backupManager;
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('mysqlbackup.php'),
        ]);
    }
}