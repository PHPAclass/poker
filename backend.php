<?php
    session_start();
    require_once('player.php');

    switch ($_POST['select'])
    {
        case "raise":
            raise();
        case "call":
            call();
        case "fold":
            fold();
    }

    function main()
    {
        session_destroy();
        start();
        var_dump($_SESSION['your_status']);
    }

    function start()
    {
        $_SESSION['player_turn'] = 1; #自分を1とする
        $_SESSION['your_status'] = new Player(10000, 100);
        $_SESSION['enemy2_status'] = new Player(10000, 100);
        $_SESSION['enemy3_status'] = new Player(10000, 100);
        $_SESSION['enemy4_status'] = new Player(10000, 100);


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


    function raise()
    {
        $_SESSION['your_status']->stack += 50;
        $_SESSION['enemy2_status']->stack += 50;
        $_SESSION['enemy3_status']->stack += 50;
        $_SESSION['enemy4_status']->stack += 50;
        return 0;
    }

    function call()
    {

        return 0;
    }

    function fold()
    {
        switch ($_SESSION['player_turn'])
        {
            case 1:
                var_dump($_SESSION['your_status']);
                break;
            case 2:

                break;
            case 3:
                break;
            case 4:
                break;
            default:
                var_dump($_SESSION['player_turn']);
        }
        setMoney($foldPerson);
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
