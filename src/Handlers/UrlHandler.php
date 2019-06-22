<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\UrlWrapper;

/**
 * Class Url
 * @package devtoolboxuk\cerberus\Handlers
 */
class UrlHandler extends Handler
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setHandlerName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
        $this->pushWrapper(new UrlWrapper());
    }
}