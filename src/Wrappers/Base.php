<?php

namespace devtoolboxuk\cerberus\Wrappers;

use devtoolboxuk\soteria\SoteriaService;

abstract class Base
{


    protected $soteria;
    protected $score = 0;
    private $passScore = 0;
    private $failScore = 0;

    private $realScore = 0;
    private $options = [];
    private $results = null;

    private $params = [];

    private $name;
    private $active;
    private $reference;

    private $output = null;

    public function __construct()
    {
        $this->soteria = new SoteriaService();
    }

    public function getOutput()
    {
        return $this->output;
    }

    protected function setOutput($value)
    {
        $this->output = $value;
        return $this;
    }

    public function setOptions($reference, $options = [])
    {
        $this->reference = $reference;
        $this->options = $options;
        return $this;
    }

    public function inParams($name)
    {
        if (in_array($name, $this->getParams())) {
            return true;
        }
        return false;
    }

    protected function getParams()
    {
        return $this->params;
    }

    protected function setParams($params)
    {
        $this->params = explode("|", $params);
        return $this;
    }

    public function getRuleOption($name, $score)
    {
        if (!$this->hasRuleOption($name)) {
            return $score;
        }

        return $this->options[$this->name][$name];
    }

    public function hasRuleOption($name)
    {
        return isset($this->options[$this->name][$name]);
    }

    public function getResult()
    {
        return $this->results;
    }

    protected function overRideScore($data)
    {
        $sanitise = $this->soteria->sanitise();
        $this->score = $this->getRealScore();

        if (isset($data[1])) {

            $scoreData = explode(",", $data[1]);

            if (count($scoreData) == 2) {
                $sanitise->disinfect($scoreData[0], 'int');
                $this->score = (int)$sanitise->result()->getOutput();
                $sanitise->disinfect($scoreData[1], 'int');
                $this->passScore = (int)$sanitise->result()->getOutput();
            } else {
                $sanitise->disinfect($scoreData[0], 'int');
                $this->score = (int)$sanitise->result()->getOutput();
            }
        }
        $this->failScore = $this->score;
        $this->score += (-1 * abs($this->passScore));
    }

    public function getFailScore()
    {
        return $this->failScore;
    }

    public function getRealScore()
    {
        if (!$this->hasRealScore()) {
            return 0;
        }

        return $this->realScore;
    }

    private function hasRealScore()
    {
        return isset($this->realScore);
    }

    protected function pushResult($result)
    {
        array_unshift($this->results, $result);
    }

    protected function sanitizeReference()
    {
        return str_replace(" ", "", strip_tags(trim($this->getReference())));
    }

    protected function getReference()
    {
        $this->setOutput($this->reference);
        return $this->reference;
    }

    protected function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    protected function initWrapper($name)
    {
        $this->setName($name);
        $this->setRules();
    }

    protected function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    private function setRules()
    {
        $this->options = $this->getOption($this->getName());

        $this->setRealScore($this->getOption('score'));
        $this->setActive($this->getOption('active'));
        $this->setParams($this->getOption('params'));
    }

    public function getOption($name)
    {
        if (!$this->hasOption($name)) {
            return null;
        }

        return $this->options[$name];
    }

    public function hasOption($name)
    {
        return isset($this->options[$name]);
    }

    private function getName()
    {
        return $this->name;
    }

    private function setRealScore($score)
    {

        if (is_array($score)) {
            $this->realScore = (int)$score['fail'];
            $this->passScore = (int)$score['pass'];
        } else {
            $this->realScore = (int)$score;
        }
        $this->failScore = $this->realScore;
        $this->realScore += (-1 * abs($this->passScore));

    }

    private function setActive($active)
    {
        $this->active = $active;
    }

    protected function setResult()
    {
        if ($this->getActive()) {
            $this->results[$this->getName()] = $this->getScore();
            $this->score = $this->getScore();
        } else {
            $this->score = 0;
        }
        return $this;
    }

    private function getActive()
    {
        return $this->active;
    }

    public function getScore()
    {
        if (!$this->hasScore()) {
            return 0;
        }

        return $this->score;
    }

    protected function setScore($score)
    {
        $this->score = (int)$score;
    }

    private function hasScore()
    {
        return isset($this->score);
    }

}