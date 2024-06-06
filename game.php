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
            <img src="./img/cards/<?= $_SESSION['used'][0]?>" alt="トランプ">
            <img src="./img/cards/<?= $_SESSION['used'][1] ?>" alt="トランプ">
        </div>
    </section>
    <div class="middle">
        <section class="player2">
            <p>プレイヤー2</p>
            <div>
                <img src="./img/cards/<?= $_SESSION['used'][2] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['used'][3] ?>" alt="トランプ">
            </div>
        </section>
        <section class="pot">
            <div>
                <img src="./img/cards/<?= $_SESSION['used'][4] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['used'][5] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['used'][6] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['used'][7] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['used'][8] ?>" alt="トランプ">       
            </div>
            <p>ポット:<?= $pot_point ?></p>
        </section>
        <section class="player4">
            <p>プレイヤー4</p>
            <div>
                <img src="./img/cards/<?= $_SESSION['used'][9] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['used'][10] ?>" alt="トランプ">
            </div>
        </section>
    </div>
    <section class="player1">
        <div>
            <img src="./img/cards/<?= $_SESSION['used'][11] ?>" alt="トランプ">
            <img src="./img/cards/<?= $_SESSION['used'][12] ?>" alt="トランプ">
        </div>
        <div>
            <p>プレイヤー1</p>
            <button>フォールト</button>
            <button>コール</button>
            <button>レイズ</button>
            <p>所持: <?= $my_point ?></p>
        </div>
    </section>
</body>
</html>