<?php
    session_start();
    require_once('player.php');

    function main()
    {
        start();
    }

    function start()
    {
        $your_status = new Player(10000, 100);
        $enemy1_status = new Player(10000, 100);
        
        $_SESSION['cards'] = dealCards();
    }

    function dealCards()
    {
        $numbers = range(0, 51);
        shuffle($numbers);

        return array_slice($numbers, 0, 4);

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
