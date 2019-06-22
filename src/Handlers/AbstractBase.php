<?php

namespace devtoolboxuk\cerberus\Handlers;

use ReflectionClass;

use Exception;

abstract class AbstractBase
{

    private $wrappers = [];
    private $input;
    private $output;

    private $handlerName;
    private $score;


    private $handlerReference;

    public function __construct($value)
    {
        $this->setInput($value);
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getHandlerReference()
    {
        return $this->handlerReference;
    }

    public function setHandlerReference($reference = null)
    {
        $this->handlerReference = $this->getHandlerName();
        if ($reference) {
            $this->handlerReference = $reference;
        }
        return $this;
    }

    protected function setInput($value)
    {
        $this->input = $value;
        return $this;
    }

    public function getHandlerName()
    {
        return $this->handlerName;
    }

    protected function setHandlerName($value)
    {
        $this->handlerName = $value;
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


    public function build($method, $arguments = [])
    {
        $className = __NAMESPACE__ . '\\' . ucfirst($method) . 'Handler';

        if (class_exists($className)) {

            $reflection = new ReflectionClass($className);

            if (!$reflection->isInstantiable()) {
                throw new Exception(sprintf('"%s" must be instantiable', $className));
            }

            return $reflection->newInstanceArgs($arguments);
        }
        throw new Exception(sprintf('"%s" is not a valid handler', $method));
    }

}