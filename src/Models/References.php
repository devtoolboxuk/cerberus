<?php

namespace devtoolboxuk\cerberus\Models;

class References
{

    /**
     * @var string
     */
    private $handler;

    /**
     * @var string
     */
    private $input;

    /**
     * @var string
     */
    private $output;

    private $name;

    /**
     * References constructor.
     * @param string $handler
     * @param string $input
     * @param string $output
     * @param string $name
     */
    function __construct($handler = '', $input = '', $output = '',$name = '')
    {
        $this->handler = $handler;
        $this->name = $name;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'handler' => $this->getHandler(),
            'name' => $this->getName(),
            'input' => $this->getInput(),
            'output' => $this->getOutput()
        ];
    }

    public function getName()
    {

        if ($this->name) {
            return $this->name;
        }
        return $this->getHandler();
    }

    /**
     * @return string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

}