<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\CountryHandler;
use devtoolboxuk\cerberus\Handlers\DefaultHandler;
use devtoolboxuk\cerberus\Handlers\DifferentCountryHandler;
use devtoolboxuk\cerberus\Handlers\EmailHandler;
use devtoolboxuk\cerberus\Wrappers\EmailWrapper;
use devtoolboxuk\cerberus\Wrappers\HtmlWrapper;
use devtoolboxuk\cerberus\Wrappers\UrlWrapper;
use devtoolboxuk\cerberus\Wrappers\XssWrapper;
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
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

    function testDodgyRegistration()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $login_array = [
            'email' => 'rob@shotmail.ru',
            'name' => 'Visit my website http://www.doajob.org?redirect=https://www.google.com',
            'address' => 'Some Street',
            'postcode' => 'GL1 1AA',
            'country' => 'MX',
        ];

        $detection = $cerberus
            ->pushHandler($this->createLoginStringHandler('Name', $login_array['name']))
            ->pushHandler($this->createLoginStringHandler('Address', $login_array['address']))
            ->pushHandler(new EmailHandler($login_array['email']))
            ->pushHandler(new CountryHandler($login_array['country']));

        $this->assertEquals(59, $detection->getScore());
        $this->assertEquals('{"Country":12,"DisposableEmail":"46","Url":1}', $detection->getResult());

    }

    private function getOptions()
    {
        return $this->options;
    }

    private function createLoginStringHandler($name, $data)
    {
        $handler = new DefaultHandler($name, $data);
        $handler->pushWrapper(new HtmlWrapper());
        $handler->pushWrapper(new UrlWrapper());
        $handler->pushWrapper(new XssWrapper());
        return $handler;
    }

    function testIffyCountryRegistration()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $login_array = [
            'email' => 'test@hotmail.com',
            'name' => 'Rob',
            'address' => 'Some Street',
            'postcode' => 'GL1 1AA',
            'country' => 'MX',
        ];

        $detection = $cerberus
            ->pushHandler($this->createLoginStringHandler('Name', $login_array['name']))
            ->pushHandler($this->createLoginStringHandler('Address', $login_array['address']))
            ->pushHandler(new EmailHandler($login_array['email']))
            ->pushHandler(new CountryHandler($login_array['country']));

        $this->assertEquals(12, $detection->getScore());
        $this->assertEquals('{"Country":12}', $detection->getResult());

//        print_r($detection->toArray());
//        exit();

    }

    function testValidRegistration()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $login_array = [
            'email' => 'test@hotmail.com',
            'name' => 'Rob',
            'address' => 'Some Street',
            'postcode' => 'GL1 1AA',
            'country' => 'GB',
        ];

        $detection = $cerberus
            ->pushHandler($this->createLoginStringHandler('Name', $login_array['name']))
            ->pushHandler($this->createLoginStringHandler('Address', $login_array['address']))
            ->pushHandler(new EmailHandler($login_array['email']))
            ->pushHandler(new CountryHandler($login_array['country']));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('[]', $detection->getResult());

//        print_r($detection->toArray());
//        exit();

    }


}
