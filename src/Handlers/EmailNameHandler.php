<?php

namespace devtoolboxuk\cerberus\Handlers;


use devtoolboxuk\cerberus\Wrappers\EmailNameWrapper;

class EmailNameHandler extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setHandlerName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new EmailNameWrapper());
    }
}