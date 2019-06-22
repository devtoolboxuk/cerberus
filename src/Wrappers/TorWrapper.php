<?php

namespace devtoolboxuk\cerberus\Wrappers;

class TorWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        //Check Inbound IP against the list in TorExitNodes.txt

        $this->setScore($this->getRealScore());
        $this->setResult();

    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }
}