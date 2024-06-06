<?php session_start() ?>
<?php $point = ["役なし","ワンペア","ツーペア","スリーカード","ストレート","フラッシュ","フルハウス","フォーカード","ストレートフラッシュ","ロイヤルストレートフラッシュ"]; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./backend.php" method="POST">
        <h2>自分の役:<?= $point[$_SESSION['role'][0]] ?>  |  相手の役:<?= $point[$_SESSION['role'][1]]?></h2>
        <?php if($_SESSION['win_or_lose'] == "win"):?>
            <h1>勝利</h1>
        <?php elseif($_SESSION['win_or_lose'] == "lose"): ?>
            <h1>敗北</h1>
        <?php else: ?>
            <h1>引き分け</h1>
        <?php endif?>
        <button type="submit" name="mode" value="conti">続ける</button>
        <a href="index.php">戻る</a>
    </form>
</body>
</html>