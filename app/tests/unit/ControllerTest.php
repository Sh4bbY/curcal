<?php

require_once __DIR__ . "/../../app.php";

class ControllerTest extends PHPUnit_Framework_TestCase
{
  private $calc;

  public function setup()
  {
    $this->calc = new CalculatorCtrl(4);
  }

  public function testCurrencyModel()
  {
    echo "adD-" . $this->calc->calculateByIds(2,1,1);
    $this->assertEquals(1.5897, $this->calc->calculateByIds(2,1,1));
  }
}
