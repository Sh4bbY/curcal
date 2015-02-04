<?php

class Currency
{
  private $id;
  private $code;
  private $sign;

  public function __construct($id, $code, $sign)
  {
    $this->id   = $id;
    $this->code = $code;
    $this->sign = $sign;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getSign()
  {
    return $this->sign;
  }

}
