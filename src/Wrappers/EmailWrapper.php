<?php

namespace devtoolboxuk\cerberus\Wrappers;

/**
 *
 * Detect that an email address is valid
 *
 * Class EmailWrapper
 * @package devtoolboxuk\cerberus\Wrappers
 */
class EmailWrapper extends Wrapper
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $sanitise = $this->soteria->sanitise(true);
        $sanitise->disinfect($this->getReference(), 'email');

        if (!$sanitise->result()->isValid()) {
            $this->setScore($this->getRealScore());
            $this->setResult();
        }
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

}