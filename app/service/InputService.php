<?php

class INPUT
{
  public static function get($paramerterName)
  {
    return isset($_GET[$paramerterName]) ? $_GET[$paramerterName] : null;
  }

  public static function post($paramerterName)
  {
    return isset($_POST[$paramerterName]) ? $_POST[$paramerterName] : null;
  }
}
