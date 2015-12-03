<?php

/**
 * Created by PhpStorm.
 * User: bancuadrian
 */

class SimpleDumperTest extends PHPUnit_Framework_TestCase
{
    protected $dumper;

    protected function setUp()
    {
        $user = 'vagrant';
        $pass = 'vagrant';
        $this->dumper = new BancuAdrian\MysqlBackup\Dumpers\SimpleDumper($user,$pass);
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('BancuAdrian\MysqlBackup\Dumpers\DumperInterface',$this->dumper);
    }
}