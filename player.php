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
}