<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\HtmlWrapper;

class HtmlHandler extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new HtmlWrapper());
    }
}