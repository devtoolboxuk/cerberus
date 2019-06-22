<?php

namespace devtoolboxuk\cerberus\Wrappers;

/**
 * @TODO
 * Class ReCaptcha
 * @package devtoolboxuk\cerberus\Wrappers
 */
class ReCaptchaWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }
}