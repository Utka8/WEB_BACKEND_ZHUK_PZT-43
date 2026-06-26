<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPA&CAMP — Детский оздоровительный лагерь</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <!-- NOTIFICATION BAR -->
  <div class="notification-bar" id="notificationBar">
    <span>Получите кэшбек</span>
    <div class="cashback-badge">
      <img src="icon/10.svg" alt="10%" class="percent-icon">
      <img src="icon/cashback.svg" alt="Cash Back" class="cashback-icon">
    </div>
    <a href="#">Подробнее...</a>
    <button class="notif-close" id="notifClose" aria-label="Закрыть">&#10005;</button>
  </div>

  <main>
    <?php
    include $view;
    ?>
  </main>

  <script src="js/script.js"></script>
</body>

</html>