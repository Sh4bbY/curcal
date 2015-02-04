<?php

require_once BASE_PATH . "/persistence/CurrencyDatabase.php";

class CurrencyService
{
  private static $currencies = NULL;
  private static $currencyGateway = NULL;

  private static function initialize()
  {
    if(self::$currencyGateway === NULL)
    {
      self::$currencyGateway = new CurrencyDatabase();
    }
    if(self::$currencies === NULL)
    {
      self::update();
    }
  }

  public static function getCurrencies()
  {
    self::initialize();

    return self::$currencies;
  }

  public static function getCurrency($id)
  {
    self::initialize();

    foreach(self::$currencies as $currency)
    {
      if($currency->getId() == $id)
      {
        return $currency;
      }
    }
  }

  public static function hasCurrency($id)
  {
    return self::getCurrency($id) === NULL;
  }

  public static function addCurrency($code, $sign)
  {
    self::initialize();
    self::$currencyGateway->persist($code, $sign);
    self::update();
  }

  private static function update()
  {
    self::$currencies = self::$currencyGateway->retrieveAll();
  }
}
