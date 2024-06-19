<?php
require_once('backend.php');
main();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <section class="player3">
        <p>プレイヤー3</p>
        <div>
            <img src="./img/cards/<?= $_SESSION['enemy3_status']->getCard()[0]?>" alt="トランプ">
            <img src="./img/cards/<?= $_SESSION['enemy3_status']->getCard()[1] ?>" alt="トランプ">
        </div>
    </section>
    <div class="middle">
        <section class="player2">
            <p>プレイヤー2</p>
            <div>
                <img src="./img/cards/<?= $_SESSION['enemy2_status']->getCard()[0] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['enemy2_status']->getCard()[1] ?>" alt="トランプ">
            </div>
        </section>
        <section class="pot">
            <div>
                <img src="./img/cards/<?= $_SESSION['pots'][0] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][1] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][2] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][3] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][4] ?>" alt="トランプ">
            </div>
            <p>ポット:<?= $pot_point ?></p>
        </section>
        <section class="player4">
            <p>プレイヤー4</p>
            <div>
                <img src="./img/cards/<?= $_SESSION['enemy4_status']->getCard()[0] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['enemy4_status']->getCard()[1] ?>" alt="トランプ">
            </div>
        </section>
    </div>
    <section class="player1">
        <div>
            <img src="./img/cards/<?= $_SESSION['your_status']->getCard()[0] ?>" alt="トランプ">
            <img src="./img/cards/<?= $_SESSION['your_status']->getCard()[1] ?>" alt="トランプ">
        </div>
        <div>
            <form method="POST" action="" class="action">
                <p>プレイヤー1</p>
                <button type="submit" value="fold" name="select">フォールト</button>
                <button type="submit" value="call" name="select">コール</button>
                <button type="submit" value="raise" name="select">レイズ</button>
                <p>所持: <?= $my_point ?></p>
            </form>
        </div>
    </section>
</body>
</html>
