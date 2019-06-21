<?php

namespace devtoolboxuk\cerberus\Wrappers;

class Ip extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $this->setScore($this->getRealScore());
        $this->setResult();

    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }
}