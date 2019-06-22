<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\StringLength as StringLengthWrapper;

class StringLength extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));

        $this->pushWrapper(new StringLengthWrapper());
    }
}