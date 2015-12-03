<?php


class SimpleMysqlConnectorTest extends PHPUnit_Framework_TestCase
{
    protected $bm;

    protected function setUp()
    {
        parent::__construct();
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testPrivateConstructor()
    {
        $reflection = new \ReflectionClass('\MysqlBackup\Connectors\SimpleMysqlConnector');
        $constructor = $reflection->getConstructor();

        $this->assertFalse($constructor->isPublic());
    }

//    public function testGetInstance()
//    {
//        $mysqli = $this->getMockBuilder('mysqli')
//            ->setMethods(array('query','real_escape_string'))
//            ->getMock();
//        \MysqlBackup\Connectors\SimpleMysqlConnector::connect('','','');
//    }
}