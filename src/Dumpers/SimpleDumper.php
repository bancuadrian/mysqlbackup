<?php
/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 4:36 PM
 */

namespace BancuAdrian\MysqlBackup\Dumpers;

class SimpleDumper implements DumperInterface
{
    protected $user;
    protected $pass;

    /**
     * SimpleDumper constructor.
     * @param $user
     * @param $pass
     */
    public function __construct($user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }


    /**
     * Returns dump from the database
     * @param string $database
     * @throws \Exception
     * @return string
     */
    public function getDump($database)
    {
        $output = "";
        $exitCode = 0;

        $command = "mysqldump --opt -u {$this->user} -p{$this->pass} {$database}";

        exec($command,$output,$exitCode);

        if($exitCode > 0)
        {
            throw new \Exception("mysqldump exited with a non-zero status.something must have been wrong");
        }

        return implode("\n",$output);
    }
}