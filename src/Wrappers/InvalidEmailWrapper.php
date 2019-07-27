<?php

namespace devtoolboxuk\cerberus\Wrappers;

/**
 *
 * Detect that an email address is valid
 *
 * Class EmailWrapper
 * @package devtoolboxuk\cerberus\Wrappers
 */
class InvalidEmailWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $sanitise = $this->soteria->sanitise();

        $sanitise->disinfect($this->getReference(), 'email');

        $this->setOutput($sanitise->result()->getOutput());

        if (!$sanitise->result()->isValid()) {
            $this->setScore($this->getRealScore());
        }

        $this->setResult();
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

}