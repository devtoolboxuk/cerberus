<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\Html as HtmlWrapper;
use devtoolboxuk\cerberus\Wrappers\Url as UrlWrapper;

class Text extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setHandlerName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));

        $this->pushWrapper(new HtmlWrapper());
        $this->pushWrapper(new UrlWrapper());
    }
}