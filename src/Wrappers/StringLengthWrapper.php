<?php

namespace devtoolboxuk\cerberus\Wrappers;

class StringLengthWrapper extends Wrapper
{

    private $stringLengthExceeded = null;

    public function process()
    {
        $this->initWrapper($this->setLocalName());
        $this->detect();

        if ($this->stringLengthExceeded) {
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
                $data = explode("|", $param);
                if (strpos(strtolower($this->sanitizeReference()), strtolower($data[0])) !== false) {

                    $this->setReference($data[0]);
                    $this->getStringLength($data);
                }
            }
        }
    }

    /**
     * @param array $data
     */
    private function getStringLength($data = [])
    {
        $sanitise = $this->soteria->sanitise();
        $length = 0;

        if (isset($data[1])) {
            $sanitise->disinfect($data[1], 'int');
            $length = (int)$sanitise->result()->getOutput();
        }

        $this->checkStringLength($length);
    }

    /**
     * @param int $length
     */
    private function checkStringLength($length = -1)
    {
        if ($length > 0) {
            if (mb_strlen($this->getReference()) > $length) {
                $this->stringLengthExceeded = true;
            }
        }
    }

}