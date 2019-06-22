<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\DisposableEmail;
use devtoolboxuk\cerberus\Wrappers\Email as EmailWrapper;

class Email extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setHandlerName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));

        $this->pushWrapper(new DisposableEmail());
        $this->pushWrapper(new EmailWrapper());
    }
}