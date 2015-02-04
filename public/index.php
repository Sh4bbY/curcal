<?php
  require __DIR__ . "/../app/app.php";
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="UTF-8">
  <title>CurCal</title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/main.css"/>
</head>
<body class="layout">
  <header class="l-header">
    <nav class="main-nav">
      <a href="index.php" class="main-nav-item">Calculator</a>
      <a href="index.php?action=admin" class="main-nav-item">Admin</a>
      <a href="setup.php" class="main-nav-item">Setup Database</a>
    </nav>
  </header>
  <div class="l-body">
    <div class="l-content">
      <?php

      switch(INPUT::get('action'))
      {
        case 'admin': require __DIR__ . "/../app/view/AdminView.php"; break;
        default: require __DIR__ . "/../app/view/CalculatorView.php";
      }

      ?>
    </div>
  </div>
</body>
</html>
