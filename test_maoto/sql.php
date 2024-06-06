<?php
    function select($num)
    {
        $dsn = 'mysql:host=localhost;dbname=play_cards;';
        $db_user = 'root';
        try {
            $pdo = new PDO($dsn, $db_user);
            $sql = "select * from card_variations where id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$num]);
            $card = $stmt->fetch();
        } catch (PDOException $e) {
        }
        return $card;
    }