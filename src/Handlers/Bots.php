<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\Bots as BotsWrapper;

class Bots extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setHandlerName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new BotsWrapper());
    }
}