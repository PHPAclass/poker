<?php
    session_start();
    require_once('player.php');

    function main()
    {
        session_destroy();
        start();
    }

    function start()
    {
        $your_status = new Player(10000, 100);
        $enemy1_status = new Player(10000, 100);
        
        $_SESSION['used'] = dealCards();
    }

    function dealCards()
    {
        $numbers = range(1, 52);
        shuffle($numbers);
    

        $cards = array_slice($numbers, 0, 13);
        foreach ($cards as $card) {
            $img_path[] = sql($card);
        }
        return $img_path;
    }

    function rise()
    {
        return 0;
    }


    function call()
    {
        return 0;
    }


    function fold()
    {
        return 0;
    }

    function continueGame()
    {
        return 0;
    }

    function judge()
    {
        return 0;
    }

    function enemyAction()
    {
        return 0;
    }

    function sql($id)
    {
        $dsn = 'mysql:dbname=play_card;host=localhost';
        $user = 'root';
        $password = '';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = "SELECT image FROM card_variations where id = {$id}";
            $stmt = $dbh->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = null;
            $dbh = null;
            $dsn = null;
            return $result['image'];

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }