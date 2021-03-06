<?php

namespace devtoolboxuk\cerberus\Wrappers;

/**
 *
 * Detect if a URL has been passed through
 *
 * Class UrlWrapper
 * @package devtoolboxuk\cerberus\Wrappers
 */
class UrlWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $urlSanitise = $this->soteria->sanitise();
        $urlSanitise->removeUrl($this->getReference());

        $this->setOutput($urlSanitise->result()->getOutput());

        if (!$urlSanitise->result()->isValid()) {
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