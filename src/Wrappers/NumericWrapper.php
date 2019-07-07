<?php

namespace devtoolboxuk\cerberus\Wrappers;

class NumericWrapper extends Base
{
    
    public function process()
    {
        $this->initWrapper($this->setLocalName());

        if (!is_numeric($this->getReference())) {
            $this->setScore($this->getFailScore());
        }
        $this->setResult();
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }
}