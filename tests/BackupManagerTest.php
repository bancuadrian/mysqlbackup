<?php


class BackupManager extends PHPUnit_Framework_TestCase
{
    protected $bm;

    protected function setUp()
    {
        $this->bm = new \MysqlBackup\BackupManager();
        $databases = ['databaseName1','databaseName2'];
        $this->bm->setDatabases($databases);
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('MysqlBackup\BackupManager',$this->bm);
    }

    public function testConnector()
    {
        $dumper = Mockery::mock('MysqlBackup\Dumpers\DumperInterface');
        $this->bm->setDumper($dumper);

        $this->assertInstanceOf('MysqlBackup\Dumpers\DumperInterface',$this->bm->getDumper());
    }

    public function testBackupSingleSuccessfully()
    {
        $dumper = Mockery::mock('MysqlBackup\Dumpers\DumperInterface');
        $dumper->shouldReceive('getDump')->once()->andReturn('dump');

        $persistence = Mockery::mock('MysqlBackup\Persistence\PersistenceInterface');
        $persistence->shouldReceive('persist')->once();

        $this->bm->setDumper($dumper);
        $this->bm->setPersistence($persistence);

        $result = $this->bm->backup('database1');

        $this->assertTrue($result);
    }

    public function testBackupSingleFailed()
    {
        $dumper = Mockery::mock('MysqlBackup\Dumpers\DumperInterface');
        $dumper->shouldReceive('getDump')->once()->andThrow('Exception');

        $persistence = Mockery::mock('MysqlBackup\Persistence\PersistenceInterface');
        $this->bm->setDumper($dumper);
        $this->bm->setPersistence($persistence);

        $result = $this->bm->backup('database1');

        $this->assertFalse($result);
        $this->assertEquals('database1',$this->bm->getFailedBackups()[0]);
    }

    public function testBackupAllSuccessful()
    {
        $dumper = Mockery::mock('MysqlBackup\Dumpers\DumperInterface');
        $persistence = Mockery::mock('MysqlBackup\Persistence\PersistenceInterface');

        foreach($this->bm->getDatabases() as $database)
        {
            $dumper
                ->shouldReceive('getDump')
                ->with($database)
                ->once()
                ->andReturn('dump');

            $persistence
                ->shouldReceive('persist')
                ->with('dump')
                ->once();
        }

        $this->bm->setDumper($dumper);
        $this->bm->setPersistence($persistence);

        $backupSuccessful = $this->bm->backupAll();

        $this->assertTrue($backupSuccessful);
        $this->assertEquals(0,count($this->bm->getFailedBackups()));
    }

    public function testBackupAllFailed()
    {
        $dumper = Mockery::mock('MysqlBackup\Dumpers\DumperInterface');
        $persistence = Mockery::mock('MysqlBackup\Persistence\PersistenceInterface');

        foreach($this->bm->getDatabases() as $database)
        {
            $dumper
                ->shouldReceive('getDump')
                ->with($database)
                ->once()
                ->andReturn('dump');

            $persistence
                ->shouldReceive('persist')
                ->andThrow('Exception');
        }

        $this->bm->setDumper($dumper);
        $this->bm->setPersistence($persistence);

        $result = $this->bm->backupAll();

        $this->assertFalse($result);
        $this->assertEquals(2,count($this->bm->getFailedBackups()));
        $this->assertEquals($this->bm->getDatabases()[0],$this->bm->getFailedBackups()[0]);
    }
}