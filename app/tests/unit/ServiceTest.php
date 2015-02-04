<?php

require_once __DIR__ . "/../../app.php";

class ServiceTest extends PHPUnit_Framework_TestCase
{
  public function testCurrencyService()
  {
    $this->assertTrue(CurrencyService::getCurrency(1) !== NULL);
    $this->assertTrue(CurrencyService::getCurrency(19999) === NULL);
  }

  public function testRateService()
  {
    $this->assertTrue(RateService::getRateByCurrencyIds(2,1) !== NULL);
    $this->assertTrue(RateService::getRateByCurrencyIds(123,19999) === NULL);
  }
}
