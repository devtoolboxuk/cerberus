<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
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

    public function testDisposableEmail()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $email_data = 'rob@shotmail.ru';
        $detection = $cerberus
            ->pushHandler(new Email($email_data));

        $this->assertEquals(46, $detection->getScore());
        $this->assertEquals('{"DisposableEmail":"46"}', $detection->getResult());

    }

    private function getOptions()
    {
        return $this->options;
    }

    public function testValidEmail()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $email_data = 'rob@hotmail.com';
        $detection = $cerberus
            ->pushHandler(new Email($email_data));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('[]', $detection->getResult());

    }

}
