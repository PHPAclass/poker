<?php

function sevenCard()
{
    $pot_cards = $_SESSION['pots'];
    // $player_cards = $_SESSION['your_status']->getCard();
    // array_push($player_cards, $pot_cards);
    // $enemy2_cards = $_SESSION['enemy2_status']->getCard();
    // $enemy3_cards = $_SESSION['enemy3_status']->getCard();
    // $enemy4_cards = $_SESSION['enemy4_status']->getCard();

    // $seven = [];
    // $seven['player'] = array_push($player_cards, $pot_cards);
    // $seven['enemy2'] = array_push($enemy2_cards, $pot_cards);
    // $seven['enemy3'] = array_push($enemy3_cards, $pot_cards);
    // $seven['enemy4'] = array_push($enemy4_cards, $pot_cards);

    $players = ['your','enemy2','enemy3','enemy4'];
    foreach($players as $player){
        $cards = $_SESSION[$player."_status"]->getCards();
        array_push($cards,$pot_cards);
        $seven[$player] = $cards;
    }
    var_dump($seven);
}
sevenCard();
