<?php

    // $dsn = 'mysql:host=localhost;dbname=play_card;';
    // $db_user = 'root';
    // try {
    //     $pdo = new PDO($dsn, $db_user);
    //     echo 'successfully connected';
    // } catch (PDOException $e) {
    //     exit('データベース接続失敗。' . $e->getMessage());
    // }

    // $cards_type = ['spades','hearts','diamonts','clubs'];
    // foreach($cards_type as $card_type){
    //     for ($i=1;$i<14;$i++){
    //         $image = $card_type . $i;
    //         $sql = 'INSERT INTO card_variations(type,num,image) VALUES(:arg1, :arg2, :arg3)';
    //         $stmt = $pdo->prepare($sql);
    //         $stmt->execute(array(':arg1' => $card_type, ':arg2' => $i, ':arg3' => $image));
    //     }
    // }