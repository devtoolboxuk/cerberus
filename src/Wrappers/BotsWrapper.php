<?php

namespace devtoolboxuk\cerberus\Wrappers;

class BotsWrapper extends Base
{

    private $userAgentFound = 0;

    public function process()
    {
        $this->initWrapper($this->setLocalName());

        $this->setRealReference($this->getReference());
        $this->detectBot();

        if ($this->userAgentFound > 0) {
            $this->setScore($this->score);
        }
        $this->setResult();
    }

    private function setLocalName()
    {
        $name = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        return str_replace('Wrapper', '', $name);
    }

    private function setRealReference($reference = '')
    {
        if ($reference == '') {
            $this->setReference($this->getUserAgent());
        }
    }

    private function getUserAgent()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : 'unknown';
    }

    private function detectBot()
    {

        $params = $this->getParams();
        if (empty($params)) {
            return;
        }

        foreach ($params as $param) {
            if ($param != '') {
                $data = explode(":", $param);
                if (strpos(strtolower($this->sanitizeReference()), strtolower($data[0])) !== false) {
                    $this->detectedBot($data);
                }
            }
        }

    }

    private function detectedBot($data)
    {
        if (strpos(strtolower($this->getReference()), $data) !== false) {
            $this->setRealScore();
        }
    }

    private function setRealScore($data = [])
    {
        $this->overRideScore($data);

        if ($this->score > 0) {
            $this->userAgentFound++;
        }
    }

}