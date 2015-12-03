<?php

/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date:today :)
 */
class FilePersistanceTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
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

        unlink($result);
    }

    public function testConstructWithPath()
    {
        $persistence = new \MysqlBackup\Persistence\FilePersistence('/usr/share/');

        $this->assertEquals($persistence->getPath(),'/usr/share/');
    }
}