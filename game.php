<?php
require_once('backend.php');
ini_set('display_errors', 1);
main();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="player3">
        <p>プレイヤー3</p>
        <div>
            <img src="./img/cards/<?= $_SESSION['enemy3_status']->getCard()[0]['image']?>" alt="トランプ">
            <img src="./img/cards/<?= $_SESSION['enemy3_status']->getCard()[1]['image']?>" alt="トランプ">
        </div>
    </section>
    <div class="middle">
        <section class="player2">
            <p>プレイヤー2</p>
            <div>
                <img src="./img/cards/<?= $_SESSION['enemy2_status']->getCard()[0]['image'] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['enemy2_status']->getCard()[1]['image'] ?>" alt="トランプ">
            </div>
        </section>
        <section class="pot">
            <div>
                <img src="./img/cards/<?= $_SESSION['pots'][0]['image'] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][1]['image'] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][2]['image'] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][3]['image'] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['pots'][4]['image'] ?>" alt="トランプ">
            </div>
            <h3>誰のターンか:<?=$_SESSION['player_turn']?></h3>
            <h3>総ポット数:<?=$_SESSION['total_pot']?></h3>
        </section>
        <section class="player4">
            <p>プレイヤー4</p>
            <div>
                <img src="./img/cards/<?= $_SESSION['enemy4_status']->getCard()[0]['image'] ?>" alt="トランプ">
                <img src="./img/cards/<?= $_SESSION['enemy4_status']->getCard()[1]['image'] ?>" alt="トランプ">
            </div>
        </section>
    </div>
    <section class="player1">
        <div>
            <img src="./img/cards/<?= $_SESSION['your_status']->getCard()[0]['image'] ?>" alt="トランプ">
            <img src="./img/cards/<?= $_SESSION['your_status']->getCard()[1]['image'] ?>" alt="トランプ">
        </div>
        <div>
        <p>プレイヤー1</p>
        <form method="POST" action="" class="action">
                <button type="submit" value="fold" name="select">フォールト</button>
                <button type="submit" value="call" name="select">コール</button>
                <button type="submit" value="raise" name="select">レイズ</button>
          </form>
        </div>
    </section>
</body>
</html>
<?php sevenCard(); ?>
