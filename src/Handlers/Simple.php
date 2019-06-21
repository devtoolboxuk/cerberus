<?php

namespace devtoolboxuk\cerberus\Handlers;

class Simple extends Base
{
    public function __construct($type, $value = '')
    {
        parent::__construct($value);
        $this->setName($type);
    }
}