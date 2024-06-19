<?php
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poker</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <header>
        <h1>Poker</h1>
    </header>
    <section class="home">
        <img src="./img/poker_logo.png" alt="poker logo" class="poker_logo">
        <form action="game.php" method="POST">
            <button type="submit" name="mode" value="start">Game Start</button>
        </form>
    </section>
</body>
</html>
