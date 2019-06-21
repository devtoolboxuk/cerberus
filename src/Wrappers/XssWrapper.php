<?php

namespace devtoolboxuk\cerberus\Wrappers;

/**
 *
 * Detect if XSS has been passed through
 *
 * Class XssWrapper
 * @package devtoolboxuk\cerberus\Wrappers
 */
class XssWrapper extends Wrapper
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $xss = $this->soteria->xss(true);
        $xss->clean($this->getReference());

        if (!$xss->result()->isValid()) {
            $this->setScore($this->getRealScore());
            $this->setOutput($xss->result()->getOutput());
            $this->setResult();
        }

    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }
}