<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\handlers\Handler;
use ReflectionClass;

class CerberusService extends AbstractService implements CerberusInterface
{
    private static $instance = null;
    protected $handlers = [];
    protected $references = [];

    public function __construct()
    {
        $this->resetHandlers();
    }

    /**
     * @return $this
     */
    public function resetHandlers()
    {
        $this->references = [];
        $this->handlers = [];
        self::$instance = null;
        $this->initiateServices();
        return $this;
    }

    /**
     * @param $method
     * @param array $arguments
     * @return $this
     * @throws \Exception
     */
    public function __call($method, $arguments = [])
    {
        $handlers = new Handler($arguments);
        $handler = $handlers->build($method, $arguments);
        $this->pushHandler($handler, null);
        return $this;
    }

    /**
     * @param $handler
     * @param null $reference
     * @return $this
     */
    public function pushHandler($handler, $reference = null)
    {
        $handler->setHandlerReference($reference);
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

    /**
     * @return object|null
     * @throws \ReflectionException
     */
    public function process()
    {
        foreach ($this->handlers as $key => $handler) {
            $this->processWrappers($handler);
            array_unshift($this->references, ['handler' => $handler->getHandlerName(), 'input' => $handler->getInput(), 'output' => $this->getOutput(), 'name' => $this->getHandlerName()]);
        }

        if (self::$instance === null) {
            $reflection = new ReflectionClass('devtoolboxuk\\cerberus\\Models\\Cerberus');
            self::$instance = $reflection->newInstance($this->references, $this->score, $this->result);
        }

        return self::$instance;
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getJsonLogs()
    {
        return $this->process()->getJsonLogs();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getArrayLogs()
    {
        return $this->process()->getArrayLogs();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getReferences()
    {
        return $this->process()->getReferences();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function outputs()
    {
        return $this->process()->getOutputs();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function inputs()
    {
        return $this->process()->getInputs();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function hasScore()
    {
        return $this->process()->hasScore();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getResult()
    {
        return $this->process()->getResult();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getScore()
    {
        return $this->process()->getScore();
    }

}