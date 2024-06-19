<?php
class Player
{
    private $money;
    private $stack;
    private $card;
    private $playing = True;

    public function __construct($money, $stack)
    {
        $this->money = $money;
        $this->stack = $stack;
    }

    public function getMoney()
    {
        return $this->money;
    }
    public function useMoney($num)
    {
        $this->money -= $num;
    }
    public function addMoney($num)
    {
        $this->money += $num;
    }
    public function useStack($num)
    {
        $this->stack += $num;
    }
    public function setStack($num)
    {
        $this->stack = $num;
    }
    public function getStack()
    {
        return $this->stack;
    }
    public function addStack($num)
    {
        $this->stack += $num;
    }
    public function setCards($cards)
    {
        $this->card = $cards;
    }
    public function getCards()
    {
        return $this->card;
    }
    public function showCards()
    {
        foreach($this->card as $card){
            echo "<p><img src='./img/cards/".$card['image'].".png'></p>";
        }
    }
    public function setPlaying($playing)
    {
        $this->playing = $playing;
    }
}
