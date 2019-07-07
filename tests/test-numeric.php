<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\DefaultHandler;
use devtoolboxuk\cerberus\Wrappers\NumericWrapper;
use PHPUnit\Framework\TestCase;

class NumericTest extends TestCase
{

    private $options = [];

    function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->options = $this->getTestData();
    }

    private function getTestData()
    {
        /** @noinspection PhpIncludeInspection */
        return include __DIR__ . '/options.php';
    }

    public function testNumeric()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $test_data = 123456;
        $detection = $cerberus
            ->pushHandler($this->customNumericHandler('Name', $test_data));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('{"Numeric":0}', $detection->getResult());

        $cerberus->resetHandlers();
        $test_data = "Visiting";
        $detection = $cerberus
            ->pushHandler($this->customNumericHandler('Name', $test_data));

        $this->assertEquals(55, $detection->getScore());
        $this->assertEquals('{"Numeric":55}', $detection->getResult());

    }

    private function getOptions()
    {
        return $this->options;
    }

    private function customNumericHandler($name, $data)
    {
        $handler = new DefaultHandler($name, $data);
        $handler->pushWrapper(new NumericWrapper());
        return $handler;
    }

}
