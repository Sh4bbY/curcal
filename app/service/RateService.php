<?php

require_once BASE_PATH . "/persistence/RateDatabase.php";

class RateService
{
  private static $rates = NULL;
  private static $rateGateway = NULL;

  private static function initialize()
  {
    if(self::$rateGateway === NULL)
    {
      self::$rateGateway = new RateDatabase();
    }
    if(self::$rates === NULL)
    {
      self::update();
    }
  }

  public static function getRates($doUpdate = false)
  {
    self::initialize();

    return self::$rates;
  }

  public static function getRateByCurrencyIds($from, $to)
  {
    self::initialize();

    foreach(self::$rates as $rate)
    {
      if($rate->getFrom()->getId() == $from && $rate->getTo()->getId() == $to)
      {
        return $rate;
      }
    }
  }

  public static function getRateByCurrencies($from, $to)
  {
    self::initialize();

    foreach(self::$rates as $rate)
    {
      if($rate->getFrom()->getId() == $from->getId() && $rate->getTo()->getId() == $to->getId())
      {
        return $rate;
      }
    }
  }

  public static function addRate($from, $to, $rate)
  {

    self::initialize();
    self::$rateGateway->persist($from, $to, $rate);
    self::update();
  }

  public static function update()
  {
    self::$rates = self::$rateGateway->retrieveAll();
  }
}
