<?php

namespace devtoolboxuk\cerberus\Handlers;

use devtoolboxuk\cerberus\Wrappers\XssWrapper;

class XssHandler extends Handler
{
    /**
     * XssHandler constructor.
     * @param string $value
     * @param string $keyReference
     */
    public function __construct($value = '')
    {
        parent::__construct($value);
        $this->setName(str_replace(__NAMESPACE__ . '\\', '', __CLASS__));
      //  $this->setReference($keyReference);
        $this->pushWrapper(new XssWrapper());
    }
}