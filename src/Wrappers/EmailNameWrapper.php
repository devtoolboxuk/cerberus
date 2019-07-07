<?php

namespace devtoolboxuk\cerberus\Wrappers;

class EmailNameWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        list($name, $email) = explode('|', $this->getReference());

        $name = trim($name);
        $emailName = '';
        $sanitise = $this->soteria->sanitise();
        $sanitise->disinfect($email, 'email');

        if ($sanitise->result()->isValid()) {
            $email = explode("@", $sanitise->result()->getOutput());
            $email_characters = ['.', '+', '-', '_'];
            $emailName = str_replace($email_characters, ' ', strtolower($email[0]));
        }

        $sanitise = $this->soteria->sanitise();
        $sanitise->disinfect($name);

        if ($sanitise->result()->isValid()) {
            $name = strtolower($sanitise->result()->getOutput());
        }

        if (strcasecmp($name, $emailName) == 0) {
            $this->setScore($this->getRealScore());
            $this->setResult();
        } else {
            $this->setScore($this->getFailScore());
            $this->setResult();
        }
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }
}