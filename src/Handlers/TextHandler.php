<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\HtmlWrapper;
use devtoolboxuk\cerberus\Wrappers\UrlWrapper;

class TextHandler extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));

        $this->pushWrapper(new HtmlWrapper());
        $this->pushWrapper(new UrlWrapper());
    }
}