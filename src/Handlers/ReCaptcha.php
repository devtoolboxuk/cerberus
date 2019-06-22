<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\ReCaptcha as ReCaptchaWrapper;

class ReCaptcha extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new ReCaptchaWrapper());
    }
}