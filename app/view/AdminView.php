<?php

if(INPUT::post('addRate') == 'true')
{
  $cIdFrom = INPUT::post('currency_from');
  $cIdTo = INPUT::post('currency_to');
  $rate = INPUT::post('rate');

  try
  {
    RateService::addRate($cIdFrom, $cIdTo, $rate);
  }
  catch(Exception $err)
  {
    $displayError = $err->getMessage();
  }
}

if(INPUT::post('addCurrency') == 'true')
{
  $sign = INPUT::post('code');
  $code = INPUT::post('sign');

  CurrencyService::addCurrency($code, $sign);
}

if(INPUT::get('resetDB') == 'true')
{
  $sql = file_get_contents(BASE_PATH . '/../etc/curcal.sql');
  DB::PDO()->exec($sql);
}

$currencies = CurrencyService::getCurrencies();
$rates = RateService::getRates();
$currencyOptions = "";
$currencyRows = "";
$rateRows = "";

foreach($currencies as $currency)
{
  $id   = $currency->getId();
  $code = $currency->getCode();
  $sign = $currency->getSign();

  $currencyOptions .= '<option value="'.$id.'" >'.$code.'</option>';
  $currencyRows .= '<tr><td>'.$id.'</td><td>'.$code.'</td><td>'.$sign.'</td></tr>';
}

foreach($rates as $rate)
{
  $rateRows .= '<tr><td>'.$rate->getFrom()->getCode().'</td><td>'.$rate->getTo()->getCode().'</td><td>'.$rate->getRate().'</td><td>'.$rate->getCreatedAt().'</td></tr>';
}

?>
<div class="admin">

  <?php
    if(isset($displayError))
    {
      echo $displayError;
    }
  ?>

  <div class="admin-add-currency">
    <form action="#" method="post">
      <input type="text" name="code" placeholder="Code"/>
      <input type="text" name="sign" placeholder="Sign"/>
      <input type="hidden" name="addCurrency" value="true"/>
      <input type="submit" value="add Currency"/>
    </form>
  </div>

  <hr/>

  <div class="admin-add-rate">
    <form action="#" method="post">
      <select name="currency_from">
        <?php echo $currencyOptions ?>
      </select>
      <input type="text" name="rate" placeholder="Rate"/>
      <select name="currency_to">
        <?php echo $currencyOptions ?>
      </select>
      <input type="hidden" name="addRate" value="true"/>
      <input type="submit" value="add Rate"/>
    </form>
  </div>

  <hr/>
  <a class="admin-reset-db" href="/index.php?action=admin&resetDB=true">Reset Database</a>
  <hr/>

  <div class="admin-lists">
    <h2>Currencies:</h2>

    <table>
      <thead>
      <tr><th>Id</th><th>Code</th><th>Sign</th></tr>
      </thead>
      <tbody>
      <?php  echo $currencyRows; ?>
      </tbody>
    </table>

    <h2>Rates:</h2>

    <table>
      <thead>
      <tr><th>From</th><th>To</th><th>Rate</th><th>Created At</th></tr>
      </thead>
      <tbody>
      <?php  echo $rateRows; ?>
      </tbody>
    </table>

  </div>


</div>