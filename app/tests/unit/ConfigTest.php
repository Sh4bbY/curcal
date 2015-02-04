<?php

require_once __DIR__ . "/../../app.php";

class ConfigTest extends PHPUnit_Framework_TestCase
{
  public function testConfig()
  {
    $config = new Config(BASE_PATH.'/config.ini');
    $this->assertEquals("mysql",$config->get('db_driver'));
    $this->assertEquals("root",$config->get('db_username'));
  }

  public function testStaticConfig()
  {
    $this->assertEquals("mysql",Config::GET('db_driver'));
    $this->assertEquals("root",Config::GET('db_username'));
  }

  public function testConfigNotFoundException()
  {
    $this->setExpectedException('Exception');
    $config = new Config('');
  }

  public function testConfigKeyNotFoundException()
  {
    $this->setExpectedException('Exception');
    $config = new Config(BASE_PATH.'/config.ini');
    $config->get('');
  }
}
