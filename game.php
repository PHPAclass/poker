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
    <?php
        foreach ($_SESSION['cards'] as $card) {
            echo $card, '<br>';
        }    
    ?>
    <section>
        <p>プレイヤー3</p>
        <div>
            <img src="<?= $img_path[0] ?>" alt="トランプ">
            <img src="<?= $img_path[1] ?>" alt="トランプ">
        </div>
    </section>
    <section>
        <p>プレイヤー2</p>
        <div>
            <img src="<?= $img_path[0] ?>" alt="トランプ">
            <img src="<?= $img_path[1] ?>" alt="トランプ">
        </div>
    </section>
    <section>
        <p>プレイヤー4</p>
        <div>
            <img src="<?= $img_path[2] ?>" alt="トランプ">
            <img src="<?= $img_path[3] ?>" alt="トランプ">
            <img src="<?= $img_path[4] ?>" alt="トランプ">
            <img src="<?= $img_path[5] ?>" alt="トランプ">
            <img src="<?= $img_path[6] ?>" alt="トランプ">       
        </div>
        <p>ポット:<?= $pot_point ?></p>
    </section>
    <section>
        <div>
            <img src="<?= $img_path[0] ?>" alt="トランプ">
            <img src="<?= $img_path[1] ?>" alt="トランプ">
        </div>
    </section>
    <section>
        <div>
            <img src="<?= $img_path[7] ?>" alt="トランプ">
            <img src="<?= $img_path[8] ?>" alt="トランプ">
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