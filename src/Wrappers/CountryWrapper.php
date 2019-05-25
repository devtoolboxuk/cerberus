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


        $params = $this->getParams();
        if (empty($params)) {
            return;
        }

        foreach ($params as $param) {
            if ($param != '') {
                $data = explode(":", $param);
                if (strpos(strtolower($this->sanitizeReference()), strtolower($data[0])) !== false) {
                    $this->setRealScore($data[1]);
                }
            }
        }
    }

    /**
     * @param array $data
     */
    private function setRealScore($data = [])
    {

        $sanitise = $this->soteria->sanitise(true);
        $this->score = $this->getRealScore();

        if (isset($data[1])) {
            $sanitise->disinfect($data[1], 'int');
            $this->score = (int)$sanitise->result()->getOutput();
        }

        if ($this->score > 0) {
            $this->detected++;
        }
    }

}