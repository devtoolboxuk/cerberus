<?php

namespace devtoolboxuk\cerberus\Wrappers;

class DifferentCountryWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());
        list($chosenCountry, $detectedCountry) = explode('|', $this->getReference());

        if ($chosenCountry != $detectedCountry) {
            $this->setScore($this->getFailScore());
            $this->setResult();
        } else {
            $this->setScore($this->getScore());
            $this->setResult();
        }
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

}