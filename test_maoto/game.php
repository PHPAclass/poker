<?php
require_once("./player.php");
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <h3 class="center">enemy : <?= $_SESSION['enemy_status']->getMoney() ?></h3>
    <div class="flex">
        <?php $_SESSION['enemy_status']->showCards() ?>
    </div>
    <h2 class="center">stack : <?= $_SESSION['your_status']->getStack() * 2 ?></h2>
    <div class="flex">
        <?php
        foreach($_SESSION['field'] as $card){
            echo "<h4><img src='./img/cards/".$card['image'].".png'><h4>";
        }
        ?>
    </div>
    <h3 class="center">player : <?= $_SESSION['your_status']->getMoney() ?></h3>
    <div class="flex">
        <?php $_SESSION['your_status']->showCards() ?>
    </div>
    <form action="./backend.php" method="POST" class="flex">
    <?php if(!$_SESSION['last_turn']): ?>
        <button type="submit" name="select" value="fold">フォールド</button>
        <button type="submit" name="select" value="call">コール</button>
        <button type="submit" name="select" value="raise">レイズ</button>
    <?php else: ?>
        <button type="submit" name="mode" value="check">勝敗を見る</button>
    <?php endif?>
    </form>
</body>
</html>