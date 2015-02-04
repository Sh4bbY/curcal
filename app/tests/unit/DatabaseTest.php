<?php

require_once __DIR__ . "/../../app.php";

class DatabaseTest extends PHPUnit_Framework_TestCase
{
  public function testCurrencyDatabaseRetrieve()
  {
    $curDb = new CurrencyDatabase();
    $this->assertEquals(1,$curDb->retrieve(1)->getId());
    $this->assertEquals('USD',$curDb->retrieve(1)->getCode());
    $this->assertEquals(NULL,$curDb->retrieve(9999));
  }

  public function testCurrencyDatabaseRetrieveAll()
  {
    $curDb = new CurrencyDatabase();

    $this->assertTrue(is_array($curDb->retrieveAll()));
    $this->assertTrue(sizeof($curDb->retrieveAll())>0);
  }

  public function testRateDatabaseRetrieve()
  {
    $rateDb = new RateDatabase();

    $this->assertTrue(is_numeric($rateDb->retrieve(1)->getRate()));
  }
}
