<?php

$curcal     = new CalculatorCtrl();
$currencies = CurrencyService::getCurrencies();
$selectFrom = "";
$selectTo   = "";

$from  = INPUT::get('f');
$to    = INPUT::get('t');
$value = INPUT::get('v');

foreach($currencies as $currency)
{
  $id   = $currency->getId();
  $code = $currency->getCode();

  $selectFrom .= '<option value="'.$id.'" '.($id==$from?'selected':'').' >'.$code.'</option>';
  $selectTo   .= '<option value="'.$id.'" '.($id==$to?'selected':'').' >'.$code.'</option>';
}

?>
<div class="curcal">

  <h1>
    <?php LANG::show('main','title')?>
  </h1>
  <p>
    <?php LANG::show('maim','desc')?>
  </p>

  <div class="curcal-request">
    <form action="#" method="GET">
      <select name="f">
        <?php echo $selectFrom; ?>
      </select>
      <input type="text" name="v" value="<?php echo $value ?>" placeholder="Wert" />
      <select name="t">
        <?php echo $selectTo; ?>
      </select>
      <input type="submit" value="<?php LANG::show('curcal','cta-button')?>" />
    </form>
  </div>

  <div class="curcal-response">
    <?php

      if(isset($from) && isset($to) && isset($value))
      {
        echo $curcal->calculateByIdsAndReturnString($from, $to, $value);
      }
    ?>
  </div>
</div>
