<?php

namespace devtoolboxuk\cerberus\Wrappers;

class HtmlWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        if (preg_match("/<\/?\w+((\s+\w+(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/", $this->getReference())) {
            $this->setScore($this->getRealScore());
            $this->setResult();
        }
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

}