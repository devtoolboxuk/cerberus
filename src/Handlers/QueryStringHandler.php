<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\QueryStringKeyWrapper;
use devtoolboxuk\cerberus\Wrappers\QueryStringValueWrapper;

class QueryStringHandler extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new QueryStringKeyWrapper());
        $this->pushWrapper(new QueryStringValueWrapper());
    }
}