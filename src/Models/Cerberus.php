<?php

namespace devtoolboxuk\cerberus\Models;

class Cerberus
{
    /**
     * @var array
     */
    private $references = [];

    /**
     * @var int
     */
    private $score = 0;

    /**
     * @var array
     */
    private $result = [];

    /**
     * DetectModel constructor.
     * @param array $references
     * @param int $score
     * @param array $result
     */
    function __construct($references = [], $score = 0, $result = [])
    {
        $this->addReferences($references);
        $this->score = $score;
        $this->result = $result;
    }


    /**
     * @param $references
     */
    private function addReferences($references)
    {

        foreach ($references as $reference) {

            $this->references[] = new References(
                isset($reference['handler']) ? $reference['handler'] : null,
                isset($reference['input']) ? $reference['input'] : null,
                isset($reference['output']) ? $reference['output'] : null,
                isset($reference['name']) ? $reference['name'] : null
            );
        }
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'results' => [
                'decoded' => $this->decodedResult(),
                'string' => $this->getResult(),
            ],
            'references' => $this->getReferences(),
            'score' => $this->getScore()
        ];
    }

    /**
     * @return false|string
     */
    public function getJsonLogs()
    {
        return json_encode($this->getArrayLogs());
    }

    /**
     * @return array
     */
    public function getArrayLogs()
    {
        return [
            'score'=>$this->getScore(),
            'result'=>$this->result,
            'inputs'=>$this->getInputs(),
            'outputs'=>$this->getOutputs(),
        ];
    }

    /**
     * @return array
     */
    private function decodedResult()
    {
        return $this->result;
    }

    /**
     * @return false|string
     */
    public function getResult()
    {
        return json_encode($this->result);
    }

    /**
     * @return array
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return array
     */
    public function getInputs()
    {
        $inputs = [];
        foreach ($this->references as $key => $reference) {
            $inputs[$key] = $reference->getInput();
        }
        return $inputs;
    }

    /**
     * @return array
     */
    public function getOutputs()
    {
        $outputs = [];
        foreach ($this->references as $key => $reference) {
            $outputs[$key] = $reference->getOutput();
        }
        return $outputs;
    }

    /**
     * @return bool
     */
    public function hasScore()
    {
        return ($this->getScore() > 0) ? true : false;
    }

}