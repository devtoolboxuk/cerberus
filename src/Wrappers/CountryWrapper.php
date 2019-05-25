<?php

namespace devtoolboxuk\cerberus\Wrappers;

class CountryWrapper extends Wrapper
{

    private $detected = 0;
    private $score = 0;

    public function process()
    {
        $this->initWrapper($this->setLocalName());
        $this->detect();

        if ($this->detected > 0) {
            $this->setScore($this->score);
            $this->setResult();
        }
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

    private function detect()
    {

        $sanitise = $this->soteria->sanitise(true);

        $params = $this->getParams();

        foreach ($params as $param) {
            if ($param != '') {
                $data = explode(":", $param);
                if (strpos(strtolower($this->sanitizeReference()), strtolower($data[0])) !== false) {

                    if (isset($data[1])) {
                        $sanitise->disinfect($data[1], 'int');
                    }
                    $this->score = isset($data[1]) ? (int)$sanitise->result()->getOutput() : $this->getRealScore();
                    if ($this->score > 0) {
                        $this->detected++;
                    }
                }
            }
        }

    }

}