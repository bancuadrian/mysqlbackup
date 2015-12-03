<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 10:39 AM
 */

namespace BancuAdrian\MysqlBackup;


use BancuAdrian\MysqlBackup\Dumpers\DumperInterface;
use BancuAdrian\MysqlBackup\Persistence\PersistenceInterface;

class BackupManager
{
    protected $databases;
    protected $dumper;
    protected $persistence;
    protected $failedBackups = [];

    /**
     * BackupManager constructor.
     * @param DumperInterface $dumper
     * @param PersistenceInterface $persistence
     */
    public function __construct(DumperInterface $dumper = null, PersistenceInterface $persistence = null)
    {
        $this->dumper = $dumper;
        $this->persistence = $persistence;
    }

    /**
     * Sets an array of strings with database names
     * @param array $databases
     */
    public function setDatabases(array $databases)
    {
        $this->databases = $databases;
    }

    /**
     * Returns an array of strings with database names
     * @return array
     */
    public function getDatabases()
    {
        return $this->databases;
    }

    /**
     * Sets the dumper
     * @param DumperInterface $dumper
     */
    public function setDumper(DumperInterface $dumper)
    {
        $this->dumper = $dumper;
    }

    /**
     * @return DumperInterface
     */
    public function getDumper()
    {
        return $this->dumper;
    }

    /**
     * Sets the persistence implementation
     * @param PersistenceInterface $persistence
     */
    public function setPersistence(PersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * Back up a single database. Throw exception if something happens
     * @param string $database
     * @throws Exception
     * @return bool
     */
    public function backup($database)
    {
        try {
            $dump = $this->dumper->getDump($database);
            $this->persistence->persist($dump);
        } catch (\Exception $e) {
            $this->failedBackups[] = $database;
            return false;
        }

        return true;
    }

    /**
     * Backs up every database. If something goes wrong it will return false
     * @throws Exception if connector or persistence are in trouble
     * @return bool
     */
    public function backupAll()
    {
        $allSuccessfully = true;
        $this->resetFailedBackups();

        foreach ($this->databases as $database)
        {
            if(! $this->backup($database) && $allSuccessfully)
            {
                $allSuccessfully = false;
            }
        }
        return $allSuccessfully;
    }

    /**
     *  Resets the failed backups database array
     */
    public function resetFailedBackups()
    {
        $this->failedBackups = [];
    }

    /**
     * Returns the failed backups array
     * @return array
     */
    public function getFailedBackups()
    {
        return $this->failedBackups;
    }
}