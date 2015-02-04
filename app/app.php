<?php

define('BASE_PATH', dirname(__FILE__));     //Absolute path to index

//wiring the app together

require_once BASE_PATH . "/config/config.php";
require_once BASE_PATH . "/lang/Lang.php";

require_once BASE_PATH . "/service/InputService.php";
require_once BASE_PATH . "/service/RateService.php";
require_once BASE_PATH . "/service/CurrencyService.php";

require_once BASE_PATH . "/model/ExchangeRate.php";
require_once BASE_PATH . "/model/Currency.php";

require_once BASE_PATH . "/controller/CalculatorCtrl.php";

LANG::setLanguage();
