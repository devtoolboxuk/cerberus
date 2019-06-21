<?php

namespace devtoolboxuk\cerberus\Wrappers;

class Country extends Base
{

    private $detected = 0;

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
                    $this->setRealScore($data);
                }
            }
        }
    }

    /**
     * @param array $data
     */
    private function setRealScore($data = [])
    {
        $this->overRideScore($data);

        if ($this->score > 0) {
            $this->detected++;
        }
    }

}