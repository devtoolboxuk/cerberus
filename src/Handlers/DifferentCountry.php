<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\DifferentCountry as DifferentCountryWrapper;

class DifferentCountry extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new DifferentCountryWrapper());
    }
}