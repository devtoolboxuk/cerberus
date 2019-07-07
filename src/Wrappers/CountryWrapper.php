<?php

namespace devtoolboxuk\cerberus\Wrappers;

class CountryWrapper extends Base
{

    public function process()
    {
        $this->initWrapper($this->setLocalName());
        $this->detect();

        $this->setScore($this->getScore());
        $this->setResult();
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
                    $this->overRideScore($data);
                }
            }
        }
    }


}