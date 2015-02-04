<?php

class LANG
{
  private static $localization = NULL;

  public static function setLanguage($locale = 'de')
  {
    $locale = strtolower($locale);
    $fileName = __DIR__.'/localization/' . $locale . '.php';

    if(file_exists($fileName))
    {
        self::$localization = include($fileName);
    }
    else
    {
      throw new Exception('No localization found for locale \''.$locale.'\'');
    }
  }


  public static function show($section, $key, $values = null)
  {
    echo self::get($section, $key, $values);
  }


  public static function get($section, $key, $values = null)
  {
    $result = '';

    if(array_key_exists($section, self::$localization))
    {
      $sectionArr = self::$localization[$section];

      if (array_key_exists($key, $sectionArr))
      {
        $result = $sectionArr[$key];
      }
    }

    if(isset($values))
    {
      $result = self::replace($result, $values);
    }

    return $result;
  }


  private static function replace($str, $values)
  {
    foreach($values as $key => $replace)
    {
      $search = '{'.$key.'}';
      $str = str_replace($search, $replace, $str);
    }

    return $str;
  }
}
