<?php


class Tokens
{

    private $item = [];
    private $current = 0;

    public function peek()
    {
        if (count($this->item)) {
            return $this->item[$this->current];
        }
        return null;
    }

    public function read()
    {
        return array_shift($this->item);
    }

    public function push($token,$value): void
    {
        $this->item[] = [$token,$value];
    }
}