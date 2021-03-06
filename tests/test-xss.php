<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\XssHandler;
use PHPUnit\Framework\TestCase;

class XssTest extends TestCase
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

    public function testNoXss()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $data = '<span>http://dev-toolbox.co.uk';
        $detection = $cerberus
            ->pushHandler(new XssHandler($data));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('{"Xss":0}', $detection->getResult());

    }

    private function getOptions()
    {
        return $this->options;
    }

    public function testXss()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $data = 'http://localhost/text.php/"><script>alert(“Gehackt!”);</script></form><form action="/...';
        $detection = $cerberus
            ->pushHandler(new XssHandler($data));

        $this->assertEquals(10, $detection->getScore());
        $this->assertEquals('{"Xss":10}', $detection->getResult());
    }

}
