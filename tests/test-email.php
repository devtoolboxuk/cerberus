<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\EmailHandler;
use devtoolboxuk\cerberus\Handlers\EmailNameHandler;
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
            ->pushHandler(new EmailHandler($email_data));

        $this->assertEquals(46, $detection->getScore());
        $this->assertEquals('{"InvalidEmail":0,"DisposableEmail":46}', $detection->getResult());
    }

    public function testInvalidEmail()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $email_data = 'I am not an email';
//        $email_data = 'rob@shotmail.ru';
        $detection = $cerberus
            ->pushHandler(new EmailHandler($email_data));

        $this->assertEquals(100, $detection->getScore());
        $this->assertEquals('{"InvalidEmail":100,"DisposableEmail":0}', $detection->getResult());
    }
//
    public function testEmailNameComparison()
    {
        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $email = [
            'name' => 'Rob Wilson',
            'email' => 'Rob.Wilson@test.com'
        ];

        $detection = $cerberus
            ->pushHandler(new EmailNameHandler(implode("|", $email)));

        $this->assertEquals(-5, $detection->getScore());
        $this->assertEquals('{"EmailName":-5}', $detection->getResult());

        $cerberus->resetHandlers();
        $email = [
            'name' => 'Rob Wilson',
            'email' => 'nope@test.com'
        ];

        $detection = $cerberus
            ->pushHandler(new EmailNameHandler(implode("|", $email)));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('{"EmailName":0}', $detection->getResult());

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
            ->pushHandler(new EmailHandler($email_data));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('{"InvalidEmail":0,"DisposableEmail":0}', $detection->getResult());

    }

    public function testValidEmails()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $email_data = 'rob@hotmail.com';
        $detection = $cerberus
            ->pushHandler(new EmailHandler($email_data));

        $this->assertEquals(0, $detection->getScore());
        $this->assertEquals('{"InvalidEmail":0,"DisposableEmail":0}', $detection->getResult());


        $email_data = 'rob@shotmail.ru';
        $detection = $cerberus
            ->resetHandlers()
            ->pushHandler(new EmailHandler($email_data),'email');

        $this->assertEquals(46, $detection->getScore());
        $this->assertEquals('{"InvalidEmail":0,"DisposableEmail":46}', $detection->getResult());
    }

}
