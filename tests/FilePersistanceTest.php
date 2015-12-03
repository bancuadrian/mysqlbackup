<?php

/**
 * Created by PhpStorm.
 * User: bancuadrian
 */
class FilePersistanceTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $user = 'vagrant';
        $pass = 'vagrant';
        $this->persistence = new \MysqlBackup\Persistence\FilePersistence();
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('MysqlBackup\Persistence\PersistenceInterface',$this->persistence);
    }

    public function testPersist()
    {
        $uniq_str = uniqid();
        $result = $this->persistence->persist($uniq_str);

        $this->assertTrue(file_exists($result));
        $this->assertEquals($this->persistence->read($result),$uniq_str);
    }
}