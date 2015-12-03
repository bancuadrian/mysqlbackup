<?php

/**
 * Created by PhpStorm.
 * User: bancuadrian
 * Date: 12/3/15
 * Time: 10:24 AM
 */
class FirstTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsOne()
    {
        $t = new \MysqlBackup\Class1();
        $this->assertEquals(0,$t->test());
    }
}