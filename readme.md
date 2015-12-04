![alt tag](https://travis-ci.org/bancuadrian/mysqlbackup.svg?branch=master)
[![Latest Stable Version](https://poser.pugx.org/bancuadrian/mysqlbackup/v/stable)](https://packagist.org/packages/bancuadrian/mysqlbackup)
[![Latest Unstable Version](https://poser.pugx.org/bancuadrian/mysqlbackup/v/unstable)](https://packagist.org/packages/bancuadrian/mysqlbackup)
[![License](https://poser.pugx.org/bancuadrian/mysqlbackup/license)](https://packagist.org/packages/bancuadrian/mysqlbackup)
[![Total Downloads](https://poser.pugx.org/bancuadrian/mysqlbackup/downloads)](https://packagist.org/packages/bancuadrian/mysqlbackup)

## Simple Mysql Backup Package

I wrote this simple package, so I can swiftly dump my database whenever I need to. Also, in conjunction with Laravel 5 console commands, you can quickly setup a backup schedule. If you have the time, you can make your own implementation of PersistenceInterface, and save the dumps to S3/Google Drive/etc. 

## Requirements

 - php 5.5+
 - mysqldump

## Instalation

```bash
composer require bancuadrian/mysqlbackup
```

## Usage

You can use the BackupService class to quickly start dumping databases.
```php
  <?php
      $backupStatus = \BancuAdrian\MysqlBackup\BackupService::backup('username','password',['database1','database2'],'/path/to/backup');
  ?>
```
$backupStatus returns true if all are successful, or false otherwise.

## Usage Laravel 5.*

After composer require, add this line to your config/app.php , providers section.
```php
  BancuAdrian\MysqlBackup\Support\ServiceProvider::class
```
If you want an alias, you can add this to the alias array
```php
  'BackupManager' => BancuAdrian\MysqlBackup\Support\Facade::class
```
Publish the config file
```php
  php artisan vendor:publish --provider="BancuAdrian\MysqlBackup\Support\ServiceProvider"
```
You can now find the config in config/mysqlbackup.php . Edit it to suite your needs.

You can then backup your databases using:
```php
  \BackupManager::backupAll();
  // or for single database
  \BackupManager::backup('databaseName');
```

## Features to come (soon I hope)
  * Restore
  * Backup to Google Drive
  * Backup to S3
  * Limit the number of backups in a folder

```php
  havefun() && contribute() && !criticize() && give_advice();
```
