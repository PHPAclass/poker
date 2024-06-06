<?php
    ini_set('display_errors', 1);
    require_once("./player.php");
    session_start();

    function main()
    {
        if(isset($_POST['mode'])){
            $_POST['mode']();
        }else{
            if(isset($_POST['select'])){
                $_POST['select']("your");
                enemyAction();
                $_SESSION['field'][] = dealCards();
            }
        }
        if($_SESSION['turn'] == 2){
            $_SESSION['last_turn'] = true;
        }
        $_SESSION['turn']++;
        header("Location:./game.php");
        exit();
    }

    function start()
    {
        $_SESSION['used'] = [];
        $_SESSION['turn'] = 0;
        $_SESSION['last_turn'] = false;
        $_SESSION['your_status'] = new Player(10000,100);
        $_SESSION['enemy_status'] = new Player(10000,100);
        $cards = [];
        for($i = 0; $i < 2; $i++){
            $cards[] = dealCards();
        }
        $_SESSION['your_status']->setCards($cards);
        $cards = [];
        for($i = 0; $i < 2; $i++){
            $cards[] = dealCards();
        }
        $_SESSION['enemy_status']->setCards($cards);
        $cards = [];
        for($i = 0; $i < 3; $i++){
            $cards[] = dealCards();
        }
        $_SESSION['field'] = $cards;
    }

    function dealCards()
    {
        while(true) {
            $number = random_int(1, 52);
            if(!in_array($number, $_SESSION['used'])) {
                $_SESSION['used'][] = $number;
                break;
            }
        }
        require_once("./sql.php");
        $card = select($number);
        return $card;
    }
    

    function raise($name)
    {
        $name = ["your_status","enemy_status"];
        foreach($name as $who){
            $_SESSION[$who]->addStack(50);
        }
    }


    function call($name)
    {
    }


    function fold($name)
    {
        $name = $name . "_status";
        $stack = $_SESSION[$name]->getStack();
        $_SESSION[$name]->useMoney($stack);
        if($name == "your_status"){
            $_SESSION['enemy_status']->addMoney($stack);
            $_SESSION['win_or_lose'] = "lose";
        }else{
            $_SESSION['your_status']->addMoney($stack);
            $_SESSION['win_or_lose'] = "win";
        }
        $_SESSION['your_status']->setStack(100);
        $_SESSION['enemy_status']->setStack(100);
        header("Location:./result.php");
        exit();
    }

    function conti()
    {
        $_SESSION['used'] = [];
        $_SESSION['turn'] = 0;
        $_SESSION['last_turn'] = false;
        $_SESSION['your_status']->setStack(100);
        $_SESSION['enemy_status']->setStack(100);
        $cards = [];
        for($i = 0; $i < 2; $i++){
            $cards[] = dealCards();
        }
        $_SESSION['your_status']->setCards($cards);
        $cards = [];
        for($i = 0; $i < 2; $i++){
            $cards[] = dealCards();
        }
        $_SESSION['enemy_status']->setCards($cards);
        $cards = [];
        for($i = 0; $i < 3; $i++){
            $cards[] = dealCards();
        }
        $_SESSION['field'] = $cards;
    }


    function enemyAction()
    {
        $r = random_int(0,2);
        $r = 2;
        $actions = ["raise","fold","call"];
        $actions[$r]("enemy");
    }
    function check()
    {
        $point = ["ロイヤルストレートフラッシュ"=>9,"ストレートフラッシュ"=>8,"フォーカード"=>7,"フルハウス"=>6,"フラッシュ"=>5,"ストレート"=>4,"スリーカード"=>3,"ツーペア"=>2,"ワンペア"=>1,"none"=>0];
        $your_cards = $_SESSION['your_status']->getCards();
        $your_role = [];
        $enemy_cards = $_SESSION['enemy_status']->getCards();
        $enemy_role = [];
        $field = $_SESSION['field'];
        for($i = 0; $i < 5; $i++){
            for($j = $i+1; $j < 5; $j++){
                for($k = $j + 1; $k < 5; $k++){
                    $cards = $your_cards;
                    $cards[] = $field[$i];
                    $cards[] = $field[$j];
                    $cards[] = $field[$k];
                    $your_role[] = $point[checkRole($cards)];
                    $cards = $enemy_cards;
                    $cards[] = $field[$i];
                    $cards[] = $field[$j];
                    $cards[] = $field[$k];
                    $enemy_role[] = $point[checkRole($cards)];
                }
            }
        }
        $_SESSION['role'] = [max($your_role),max($enemy_role)];
        $stack = $_SESSION['your_status']->getStack();
        if(max($your_role) == max($enemy_role)){
            $_SESSION['win_or_lose'] = "draw";
        }else if(max($your_role) > max($enemy_role)){
            $_SESSION['win_or_lose'] = "win";
            $_SESSION['your_status']->addMoney($stack * (1 + max($your_role) / 10));
            $_SESSION['enemy_status']->useMoney($stack * (1 + max($your_role) / 10));
        }else{
            $_SESSION['win_or_lose'] = "lose";
            $_SESSION['enemy_status']->addMoney($stack * (1 + max($your_role) / 10));
            $_SESSION['your_status']->useMoney($stack * (1 + max($your_role) / 10));
        }
        header("Location:./result.php");
        exit();
    }
    function checkRole($your_cards)
    {
        $your_pattern = [["pair"],["streat"],["flush"],["streat_flush"],["royal_streat_flush"]];
        $p = [];
        for($i = 0; $i < 5; $i++){
            $c = 0;
            for($j = 0; $j < 5; $j++){
                if($your_cards[$i]['num'] == $your_cards[$j]['num']){
                    $c++;
                }
            }
            if($c >= 2){
                $p[$your_cards[$i]["num"]] = $c;
            }
        }
        $your_pattern["pair"] = $p;
    
        $copy = $your_cards;
        $n = array_column($copy, 'num');
        array_multisort($n, SORT_ASC, $copy);
        for($i = 0; $i < 5; $i++){
            $flag = true;
            for($j = 0; $j < 5; $j++){
                if(($copy[$i]['num'] + $j) % 13 != ($copy[($i +$j)% 5]['num']) % 13){
                    $flag = false;
                    break;
                }
            }
            if($flag){
                $your_pattern["streat"] = ["bool"=>$flag,"start"=>$copy[$i]["num"]];
                break;
            }
        }
        if($flag == false){
            $your_pattern["streat"] = ["bool"=>$flag,"start"=>0];
        }
        
    
        $f = [];
        for($i = 0; $i < 5; $i++){
            $c = 0;
            for($j = 0; $j < 5; $j++){
                if($your_cards[$i]['type'] == $your_cards[$j]['type']){
                    $c++;
                }
            }
            $f[$your_cards[$i]["type"]] = $c;
        }
        if(max($f) == 5){
            $your_pattern["flush"] = true;
        }else{
            $your_pattern["flush"] = false;
        }
        
        $c = 0;
        $role = "none";
        if(count($your_pattern["pair"]) > 0){
            $role = "ワンペア";
            if(count($your_pattern['pair']) > 1){
                $role = "ツーペア";
            }else{
                if(max($your_cards) == 3){
                    $role = "スリーカード";
                }
            }
        }
        if($your_pattern['streat']['bool']){
            $role = "ストレート";
        }
        if($your_pattern["flush"]){
            $role = "フラッシュ";
        }
        if(count($your_pattern['pair']) == 2){
            if(max($your_pattern) == 3){
                $role = "フルハウス";
            }
        }
        if(count($your_pattern['pair']) == 1){
            if(max($your_pattern) == 4){
                $role = "フォーカード";
            }
        }
        if($your_pattern["streat"]['bool']){
            if($your_pattern["flush"]){
                $role = "ストレートフラッシュ";
                if($your_pattern["streat"]['start'] == 10){
                    $role = "ロイヤルストレートフラッシュ";
                }
            }
        }
        return $role;
    }
main();