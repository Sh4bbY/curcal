<?php

class Config
{
  private $config = NULL;
  private $filePath = NULL;
  private static $instance = NULL;

  public function __construct($filePath)
  {
    $this->filePath = $filePath;
    $this->load();
  }

  private function load()
  {
    if($this->config === NULL)
    {
      if(!file_exists($this->filePath))
      {
        throw new Exception('Configuration file not found');
      }
      else
      {
        $this->config = parse_ini_file($this->filePath);
      }
    }
  }

  public function _get($key)
  {
    if($this->config === NULL)
    {
      throw new Exception('Configuration file not loaded');
    }

    if(isset($this->config[$key]))
    {
      return $this->config[$key];
    }

    throw new Exception('Variable ' . $key . ' does not exist in configuration file');
  }

  public static function GET($key)
  {
    if(self::$instance === NULL)
    {
      self::$instance = new self(BASE_PATH . '/config.ini');
    }

    return self::$instance->_get($key);
  }
}