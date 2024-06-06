<?php
    session_start();
    require_once('player.php');


    function main()
    {
        session_destroy();
        start();
        if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['select']))){
            switch ($_POST['select'])
            {
                case "raise":
                    raise();
                case "call":
                    call();
                case "fold":
                    fold();
            }
        }
        var_dump($_SESSION['your_status']);
    }

    function start()
    {
        $_SESSION['judge'] = False;
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


    function raise(): void
    {
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['your_status']->setStack($yourStack+50);
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['enemy2_status']->setStack($yourStack+50);
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['enemy3_status']->setStack($yourStack+50);
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['enemy4_status']->setStack($yourStack+50);
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
                $yourMoney = $_SESSION['your_status']->getMoney();
                $yourMoney -= $_SESSION['your_status']->getStack();
                $_SESSION['your_status']->setMoney($yourMoney);
                break;
            case 2:
                $enemy2Money = $_SESSION['enemy2_status']->getMoney();
                $enemy2Money -= $_SESSION['enemy2_status']->getStack();
                $_SESSION['enemy2_status']->setMoney($enemy2Money);
                break;
            case 3:
                $enemy3Money = $_SESSION['enemy3_status']->getMoney();
                $enemy3Money -= $_SESSION['enemy3_status']->getStack();
                $_SESSION['enemy3_status']->setMoney($enemy3Money);
                break;
            case 4:
                $enemy4Money = $_SESSION['enemy4_status']->getMoney();
                $enemy4Money -= $_SESSION['enemy4_status']->getStack();
                $_SESSION['enemy4_status']->setMoney($enemy4Money);
                break;
            default:
                var_dump($_SESSION['player_turn']);
        }
        return 0;
    }

    function continueGame()
    {
        return 0;
    }

    function judge()
    {

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

    function sqljudge($id, $sql)
    {
        $dsn = 'mysql:dbname=play_card;host=localhost';
        $user = 'root';
        $password = '';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = $sql;
            $stmt = $dbh->query($query);

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
