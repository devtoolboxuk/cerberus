<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\DisposableEmailWrapper;
use devtoolboxuk\cerberus\Wrappers\InvalidEmailWrapper;

class EmailHandler extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setHandlerName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));

        $this->pushWrapper(new DisposableEmailWrapper());
        $this->pushWrapper(new InvalidEmailWrapper());
    }
}