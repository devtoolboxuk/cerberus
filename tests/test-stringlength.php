<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\Country;
use devtoolboxuk\cerberus\Handlers\DifferentCountry;
use PHPUnit\Framework\TestCase;

class StringLength extends TestCase
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

    public function testDifferentCountry()
    {
        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());


        $country = [
            'in' => 'Some Random String',
            'length' => 32
        ];

        $detection = $cerberus
            ->pushHandler(new DifferentCountry(implode("|", $country)));

        $this->assertEquals(50, $detection->getScore());
        $this->assertEquals('{"DifferentCountry":50}', $detection->getResult());

        $cerberus->resetHandlers();
        $country = [
            'in' => 'GB',
            'base' => 'GB'
        ];

        $detection = $cerberus
            ->pushHandler(new DifferentCountry(implode("|", $country)));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('[]', $detection->getResult());

    }

    private function getOptions()
    {
        return $this->options;
    }

    public function testCountry()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $detected_country = 'MX';
        $detection = $cerberus
            ->pushHandler(new Country($detected_country));

        $this->assertEquals(12, $detection->getScore());
        $this->assertEquals('{"Country":12}', $detection->getResult());

        $cerberus->resetHandlers();
        $detected_country = 'US';
        $detection = $cerberus->pushHandler(new Country($detected_country));

        $this->assertEquals(15, $detection->getScore());
        $this->assertEquals('{"Country":15}', $detection->getResult());

        $cerberus->resetHandlers();
        $detected_country = 'GB';
        $detection = $cerberus->pushHandler(new Country($detected_country));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('[]', $detection->getResult());

        $cerberus->resetHandlers();
        $detected_country = 'RU';
        $detection = $cerberus->pushHandler(new Country($detected_country));

        $this->assertEquals(11, $detection->getScore());
        $this->assertEquals('{"Country":11}', $detection->getResult());

    }


}
