<?php

require_once __DIR__ . "/../../app.php";

class CalculatorTest extends PHPUnit_Framework_TestCase
{
  public function testCurrencyModel()
  {
    $currency = new Currency(1,'USD','$');
    $this->assertEquals(1, $currency->getId());
    $this->assertEquals('USD', $currency->getCode());
    $this->assertEquals('$', $currency->getSign());
  }

  public function testRateModel()
  {
    $currencyFrom = new Currency(1,'USD','$');
    $currencyTo = new Currency(2,'EUR','€');

    $rate = new ExchangeRate($currencyFrom, $currencyTo, 1.234);
    $this->assertEquals($currencyFrom, $rate->getFrom());
    $this->assertEquals($currencyTo, $rate->getTo());
    $this->assertEquals(1.234, $rate->getRate());
  }

  public function testRateModel_createByArray()
  {
    $data = array(
        'rate' => 1.5,
        'from_id' => 2,
        'from_code' => 'EUR',
        'from_sign' => '€',
        'to_id' => 1,
        'to_code' => 'USD',
        'to_sign' => '$',
        'created_at' => '2015-02-03 21:25:08'
    );

    $rate = ExchangeRate::createByArray($data);

    $this->assertEquals(1.5, $rate->getRate());
    $this->assertEquals(2, $rate->getFrom()->getId());
    $this->assertEquals('EUR', $rate->getFrom()->getCode());
    $this->assertEquals('€', $rate->getFrom()->getSign());
    $this->assertEquals(1, $rate->getTo()->getId());
    $this->assertEquals('USD', $rate->getTo()->getCode());
    $this->assertEquals('$', $rate->getTo()->getSign());
    $this->assertEquals('2015-02-03 21:25:08', $rate->getCreatedAt());
  }
}
