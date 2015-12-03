<?php

/**
 * Created by PhpStorm.
 * User: bancuadrian
 */

class SimpleDumper extends PHPUnit_Framework_TestCase
{
    protected $dumper;

    protected function setUp()
    {
        $user = 'vagrant';
        $pass = 'vagrant';
        $this->dumper = new MysqlBackup\Dumpers\SimpleDumper($user,$pass);
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('MysqlBackup\Dumpers\DumperInterface',$this->dumper);
    }
}