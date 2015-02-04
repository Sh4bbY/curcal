<?php
  require __DIR__ . "/../app/app.php";
  try {
    $pdo = new PDO(Config::GET('db_driver') . ':host=' . Config::GET('db_host') . ';charset=' . Config::GET('db_charset'), Config::GET('db_username'), Config::GET('db_password'));
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = file_get_contents(BASE_PATH . '/../etc/curcal.sql');
    $pdo->exec($sql);
  }
  catch(Exception $err)
  {
    echo "Error while setting up Database: </br>";
    echo $err->getMessage();
    exit();
  }
  header('location: /');
?>
