<?php

class CalculatorCtrl
{
  private $precision = NULL;

  public function __construct($precision = 4)
  {
    $this->precision = $precision;
  }

  public function calculateByIds($from, $to, $value)
  {
    $from = trim($from);
    $to = trim($to);
    $value = trim($value);

    try
    {
      $this->checkInputs($from, $to, $value);

      if($from == $to)
      {
        return $value;
      }
      else
      {
        $rate = RateService::getRateByCurrencyIds($from, $to);

        if(!isset($rate))
        {
          return false;
        }

        return $this->calculateByRate($rate, $value);
      }
    }
    catch(Exception $err)
    {
      return false;
    }
  }

  public function calculateByIdsAndReturnString($from, $to, $value)
  {
    try
    {
      $this->checkInputs($from,$to,$value);
      $result = $this->calculateByIds($from,$to,$value);

      $values = array(
          'value' => $value,
          'result' => $result,
          'sign_from' => CurrencyService::getCurrency($from)->getSign(),
          'sign_to' => CurrencyService::getCurrency($to)->getSign()
      );
      return LANG::get('curcal','result-string', $values);
    }
    catch(Exception $err)
    {
      return $err->getMessage();
    }
  }

  private function checkInputs($from, $to, $value)
  {
    if(strlen($value) === 0 || strlen($to) === 0 || strlen($from) === 0
        || !is_numeric($value) || !is_numeric($to) || !is_numeric($from))
    {
      throw new  Exception(LANG::get('error','invalid-input'));
    }

    if(RateService::getRateByCurrencyIds($from, $to) == NULL)
    {
      $cFrom = CurrencyService::getCurrency($from);
      $cTo = CurrencyService::getCurrency($to);

      throw new Exception(LANG::get('error','no-rate-found', array($cFrom->getCode(), $cTo->getCode())));
    }
  }

  private function calculateByRate($rate, $value)
  {
    if(isset($rate))
    {
      return round($value * $rate->getRate(), $this->precision);
    }

    return "no rate found";
  }
}
