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
    $this->app->singleton('mysql.backup.manager',function($app){
        $dumper = new SimpleDumper("test","123");
        $persistence = new FilePersistence();

        return new BackupManager($dumper,$persistence);
    });
}
}