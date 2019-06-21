<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\Html;
use devtoolboxuk\cerberus\Wrappers\Url;

class Text extends Base
{
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));

        $this->pushWrapper(new Html());
        $this->pushWrapper(new Url());
    }
}