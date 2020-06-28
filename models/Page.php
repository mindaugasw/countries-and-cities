<?php

class Page
{
    public $number;
    public $name;
    public $active;

    public function __construct(int $number, string $name, bool $active)
    {
        $this->number = $number;
        $this->name = $name;
        $this->active = $active;
    }
}