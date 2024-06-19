<?php
class Player
{
    private $money;
    private $stack;
    private $card;

    public function __construct($money, $stack)
    {
        $this->money = $money;
        $this->stack = $stack;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function setMoney($money)
    {
        return $this->money = $money;
    }

    public function getStack()
    {
        return $this->stack;
    }

    public function setStack($stack)
    {
        return $this->stack = $stack;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function setCard($card)
    {
        $this->card = $card;
    }

}
