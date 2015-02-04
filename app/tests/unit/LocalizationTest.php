<?php

require_once __DIR__ . "/../../app.php";

class LocalizationTest extends PHPUnit_Framework_TestCase
{
  public function testInvalidInput()
  {
    $this->assertEquals("string", gettype(LANG::get('main','title')));
    $this->assertTrue(strlen(LANG::get('main','title')) > 0);

    $this->assertEquals("", LANG::get('main','INVALID_KEY'));
    $this->assertEquals("", LANG::get('INVALID_SECTION','title'));
    $this->assertEquals("", LANG::get('INVALID_SECTION','title', array()));
    $this->assertEquals("", LANG::get('INVALID_SECTION','title', array(1,2,3)));
  }

  public function testLanguageKeys()
  {
    $this->assertTrue(strlen(LANG::get('main','title')) > 0);
    $this->assertTrue(strlen(LANG::get('main','desc')) > 0);

    $this->assertTrue(strlen(LANG::get('curcal','cta-button')) > 0);
    $this->assertTrue(strlen(LANG::get('curcal','result-string')) > 0);

    $this->assertTrue(strlen(LANG::get('error','no-rate-found')) > 0);
    $this->assertTrue(strlen(LANG::get('error','invalid-input')) > 0);
    //$this->assertTrue(strlen(LANG::get('error','add-rate-same-ids')) > 0);
  }
}
