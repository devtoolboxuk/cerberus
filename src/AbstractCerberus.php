<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\soteria\SoteriaService;

abstract class AbstractCerberus
{

    protected $options = [];
    protected $results = [];
    protected $result = [];
    protected $score = 0;
    protected $soteria;

    public function __construct()
    {
        $this->soteria = new SoteriaService();
        $this->setOptions();
    }

    /**
     * @param array $options
     */
    public function setOptions($options = [])
    {
        $baseOptions = new BaseOptions();
        $this->options = $this->arrayMergeRecursiveDistinct($baseOptions->getOptions(), $options);
    }

    /**
     * @param $file
     */
    public function setOptionsWithFile($file)
    {
        if ($this->isYamlLoaded()) {
            $this->soteria->sanitise()->disinfect($file, 'url');
            if ($this->soteria->sanitise()->result()->isValid()) {
                $this->options = $this->arrayMergeRecursiveDistinct($this->options, yaml_parse_file($file));
            } else {
                if (file_exists($file)) {
                    $this->options = $this->arrayMergeRecursiveDistinct($this->options, yaml_parse_file($file));
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
     * @param array $merged
     * @param array $array2
     * @return array
     */
    private function arrayMergeRecursiveDistinct($merged = [], $array2 = [])
    {
        if (empty($array2)) {
            return $merged;
        }

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->arrayMergeRecursiveDistinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }
        return $merged;
    }

    /**
     * @param $handler
     */
    protected function processWrappers($handler)
    {
        $options = $this->getOption('Detection');

        foreach ($handler->getWrappers() as $wrapper) {

            $wrapper->setOptions($handler->getValue(), $options['Rules']);
            $wrapper->process();
            $this->addResult($wrapper->getScore(), $wrapper->getResult());
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


}