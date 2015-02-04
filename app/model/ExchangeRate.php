<?php

class ExchangeRate
{
  private $rate;
  private $createdAt;
  private $from;
  private $to;

  public function __construct(Currency $from, Currency $to, $rate)
  {
    $this->from       = $from;
    $this->to         = $to;
    $this->rate       = $rate;
  }

  public static function createByArray(Array $data)
  {
    try
    {
      $rate      = $data['rate'];
      $from      = new Currency($data['from_id'], $data['from_code'], $data['from_sign']);
      $to        = new Currency($data['to_id'], $data['to_code'], $data['to_sign']);

      $instance = new self($from, $to, $rate);
      $instance->createdAt = $data['created_at'];

      return $instance;
    }
    catch(Exception $err)
    {
      echo "Error @ExchangeRate construction:<br/>" . $err;
    }
  }

  public function getRate()
  {
    return $this->rate;
  }

  public function getFrom()
  {
    return $this->from;
  }

  public function getTo()
  {
    return $this->to;
  }

  public function getCreatedAt()
  {
    return $this->createdAt;
  }
}
