<?php
    $your_cards = [
        ["id"=>2,"type"=>"heart","num"=>12],
        ["id"=>1,"type"=>"diamond","num"=>1],
        ["id"=>15,"type"=>"heart","num"=>3],
        ["id"=>1,"type"=>"heart","num"=>2],
        ["id"=>1,"type"=>"heart","num"=>1]
    ];
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
            foreach($your_pattern['pair'] as $num){
                if($num > 2){
                    $role = "スリーカード";
                }
            }
        }
    }
    if($your_pattern['bool']){
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
        if($your_cards["flush"]){
            $role = "ストレートフラッシュ";
            if($your_pattern["streat"]['start'] == 10){
                $role = "ロイヤルストレートフラッシュ";
            }
        }
    }
    