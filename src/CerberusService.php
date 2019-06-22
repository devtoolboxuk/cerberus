<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\handlers\Handler;
use ReflectionClass;

class CerberusService extends AbstractCerberus implements CerberusInterface
{
    private static $instance = null;
    protected $handlers = [];
    protected $references = [];

    public function __construct()
    {
        $this->resetHandlers();
    }


    public function resetHandlers()
    {
        $this->references = [];
        $this->handlers = [];
        self::$instance = null;
        return $this;
    }

    public function __call($method, $arguments = [])
    {
        $handlers = new Handler($arguments);
        $handler = $handlers->build($method, $arguments);
        $this->pushHandler($handler);
        return $this;
    }

    public function pushHandler($handler, $reference = null)
    {

        $handler->setReference($reference);
        array_unshift($this->handlers, $handler);
        $this->clearResults();
        return $this;
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function toArray()
    {
        return $this->process()->toArray();
    }
    public function getJsonLogs()
    {
        return $this->process()->getJsonLogs();
    }
    public function getArrayLogs()
    {
        return $this->process()->getArrayLogs();
    }
    public function getReferences()
    {
        return $this->process()->getReferences();
    }

    /**
     * @return object|null
     * @throws \ReflectionException
     */
    public function process()
    {
        foreach ($this->handlers as $key => $handler) {
            $this->processWrappers($handler);
            array_unshift($this->references, ['handler' => $handler->getName(), 'input' => $handler->getInput(), 'output' => $this->getOutput(), 'name' => $this->getHandlerName()]);
        }

        if (self::$instance === null) {
            $reflection = new ReflectionClass('devtoolboxuk\\cerberus\\Models\\Cerberus');
            self::$instance = $reflection->newInstance($this->references, $this->score, $this->result);
        }

        return self::$instance;
    }

    public function outputs()
    {
        return $this->process()->getOutputs();
    }

    public function inputs()
    {
        return $this->process()->getInputs();
    }

    public function hasScore()
    {
        return $this->process()->hasScore();
    }

    public function getResult()
    {
        return $this->process()->getResult();
    }

    public function getScore()
    {
        return $this->process()->getScore();
    }

}