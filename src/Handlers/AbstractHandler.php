<?php

namespace devtoolboxuk\cerberus\Handlers;

abstract class AbstractHandler
{
//    private $active = false;
    private $wrappers = [];
    private $input;
    private $output;

    private $name;
//    private $prefixes;
    private $score;


    private $reference;

    public function __construct($value)
    {
        $this->setInput($value);
    }

    public function getInput()
    {
        return $this->input;
    }
    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference = null)
    {
        $this->reference = $this->getName();
        if ($reference) {
            $this->reference = $reference;
        }
        return $this;
    }

    protected function setInput($value)
    {
        $this->input = $value;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function setName($value)
    {
        $this->name = $value;
        return $this;
    }



    public function getOutput()
    {
        return $this->output;
    }

    protected function setOutput($value)
    {
        $this->output = $value;
        return $this;
    }

    public function getWrappers()
    {
        return $this->wrappers;
    }
//
//    public function isActive()
//    {
//        return $this->active;
//    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    public function pushWrapper($wrapper)
    {
        array_unshift($this->wrappers, $wrapper);
        return $this;
    }

//    protected function getPrefixes()
//    {
//        return $this->prefixes;
//    }

}