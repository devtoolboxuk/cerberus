<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\soteria\SoteriaService;
use devtoolboxuk\utilitybundle\UtilityService;

abstract class AbstractService
{

    protected $options = [];
    protected $results = [];
    protected $result = [];
    protected $score = 0;
    protected $soteria;

    protected $output;
    protected $handlerName;


    protected $arrayUtility;

    public function __construct()
    {
        $this->initiateServices();
        $this->setOptions();
    }

    protected function initiateServices()
    {
        $this->soteria = new SoteriaService();
        $utilityService = new UtilityService();
        $this->arrayUtility = $utilityService->arrays();
    }

    /**
     * @TODO - Add pass in json file
     * @param $file
     */
    public function setOptionsWithFile($file)
    {
        if ($this->isYamlLoaded()) {
            $this->soteria->sanitise()->disinfect($file, 'url');
            if ($this->soteria->sanitise()->result()->isValid()) {
                $this->options = $this->arrayUtility->arrayMergeRecursiveDistinct($this->options, yaml_parse_file($file));
            } else {
                if (file_exists($file)) {
                    $this->options = $this->arrayUtility->arrayMergeRecursiveDistinct($this->options, yaml_parse_file($file));
                }
            }
        }
    }

    /**
     * @return bool
     */
    private function isYamlLoaded()
    {
        return extension_loaded('yaml');
    }

    /**
     * @param $handler
     */
    protected function processWrappers($handler)
    {
        $options = $this->getOption('Detection');

        foreach ($handler->getWrappers() as $wrapper) {

            $wrapper->setOptions($handler->getInternalInput(), $options['Rules']);
            $wrapper->process();
            $this->addResult($wrapper->getScore(), $wrapper->getResult());
            $this->addOutput($wrapper->getOutput());
            $handler->setInternalInput($wrapper->getOutput());

            $this->addHandlerName($handler->getHandlerReference());
        }
    }

    /**
     * @param $name
     * @return mixed|null
     */
    private function getOption($name)
    {
        if (!$this->hasOption($name)) {
            return null;
        }

        return $this->options[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    private function hasOption($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * @param $score
     * @param $result
     * @return $this
     */
    protected function addResult($score, $result)
    {
        if (is_array($result)) {
            $this->addScore($score);
            $this->result = array_merge($this->result, $result);
        }
        return $this;
    }

    /**
     * @param $score
     * @return $this
     */
    private function addScore($score)
    {
        $this->score += $score;
        return $this;
    }

    protected function addOutput($value)
    {
        $this->output = $value;
        return $this;
    }

    protected function addHandlerName($handlerName)
    {
        $this->handlerName = $handlerName;
        return $this;
    }

    protected function getOutput()
    {
        return $this->output;
    }

    protected function getHandlerName()
    {
        return $this->handlerName;
    }

    protected function clearResults()
    {
        $this->results = [];
        $this->result = [];
        $this->score = 0;
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options = [])
    {
        $baseOptions = new BaseOptions();
        $this->options = $this->arrayUtility->arrayMergeRecursiveDistinct($baseOptions->getOptions(), $options);
    }


}