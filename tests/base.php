<?php

namespace devtoolboxuk\cerberus;

use devtoolboxuk\cerberus\Handlers\Email;
use devtoolboxuk\cerberus\Handlers\Text;
use devtoolboxuk\cerberus\Handlers\ThrottleHandler;
use devtoolboxuk\cerberus\Handlers\Xss;
use PHPUnit\Framework\TestCase;

class xDetectionTest extends TestCase
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

    function testEmailDetection()
    {

        $cerberus = new CerberusService();
        $cerberus->setOptions($this->getOptions());

        $dataX = '<span>http://dev-toolbox.co.uk';
        $email_data = 'rob@shotmail.ru';
//
//        $detection = $cerberus
//            ->pushHandler(new EmailHandler($email_data))
//            ->pushHandler(new TextHandler($data));
//
////        print_r($detection->toArray());
//        print_r($detection->getResult());
//

//        echo "\n";
        $email_data = 'rob@hotmail.com';
//        $detection = $cerberus
//            ->resetHandlers()
//            ->pushHandler(new EmailHandler($email_data))
//            ->pushHandler(new TextHandler($data));
//
//        print_r($detection->toArray());
//        print_r($detection->getResult());
//        print_r($detection->isBlocked());
//


        $data = 'http://localhost/text.php/"><script>alert(“Gehackt!”);</script></form><form action="/...';
        $detection = $cerberus
            ->resetHandlers()
            ->pushHandler(new Xss($data),'sdf')
            ->pushHandler(new Email($email_data))
        ;


//        print_r($detection->getJsonLogs());
//
        print_r($detection->getReferences());
//        print_r($detection->getScore());

        echo "\n\n";

    }

    private function getOptions()
    {
        return $this->options;
    }


//    function testUrlDetection()
//    {
//        $cerberus = new cerberusService();
//        $cerberus->setOptions($this->getOptions());
//        $data = '<span>http://google.com';
//        $detection = $cerberus
//            ->resetHandlers()
//            ->pushHandler(new TextHandler($data));
//        $this->assertEquals(2,$detection->getScore());
//
//    }
//
//    function getOptions()
//    {
//        echo "\n";
//        $options = [
//            'config' => [
//                'threshold' => 100,
//                'hashing' => [
//                    'key' => 'test_key'
//                ]
//            ],
//            'Detection' => [
//                'Rules' => [
//                    'html' => [
//                        'active' => 1,
//                        'score' => '46',
//                        'params' => ''
//                    ],
//                    'DisposableEmail' => [
//                        'active' => 1,
//                        'score' => '46',
//                        'params' => ''
//                    ],
//                    'bot' => [
//                        'active' => 1,
//                        'params' => 'sensu'
//                    ]
//                ]
//            ]
//        ];
//
//        return $options;
//    }
//
//    function testEmailDetection()
//    {
//
//        $cerberus = new Detect();
//        $cerberus->setOptions($this->getOptions());
//
//        $email_data = 'rob@shotmail.ru';
//
//        $detection = $cerberus
//            ->resetHandlers()
//            ->pushHandler(new EmailHandler($email_data));
//        $this->assertEquals(46,$detection->getScore());
//
//    }
}
