<?php

namespace devtoolboxuk\cerberus;

class BaseOptions
{

    public function getOptions()
    {
        return [
            'Detection' => [
                'Rules' => [
                    'BotBlock' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '360Spider'
                    ],
                    'Html' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'ReCaptcha' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '1.0:0|0.0:100',
                    ],
                    'StringLength' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'Numeric' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'Url' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'Ip' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'Tor' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'EmailName' => [
                        'active' => 0,
                        'score' => [
                            'fail' => 0,
                            'pass' => 0
                        ],
                        'params' => ''
                    ],
                    'DisposableEmail' => [
                        'active' => 1,
                        'score' => 10,
                        'params' => '',
                    ],
                    'InvalidEmail' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'QueryStringKey' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'QueryStringValue' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => '',
                    ],
                    'DifferentCountry' => [
                        'active' => 1,
                        'score' => 10,
                        'params' => '',
                    ],
                    'Country' => [
                        'active' => 1,
                        'score' => 10,
                        'params' => '',
                    ],
                    'Xss' => [
                        'active' => 1,
                        'score' => 10,
                        'params' => '',
                    ]
                ]
            ]

        ];

    }

}