<?php
return [
    'Detection' => [
        'Rules' => [
            'html' => [
                'active' => 1,
                'score' => [
                    'fail' => 46,
                    'pass' => 0
                ],
                'params' => ''
            ],
            'DisposableEmail' => [
                'active' => 1,
                'score' => [
                    'fail' => 46,
                    'pass' => 0
                ],
                'params' => ''
            ],
            'Numeric' => [
                'active' => 1,
                'score' =>[
                    'fail' => 55,
                    'pass' => 55
                ],
                'params' => '',
            ],
            'EmailName' => [
                'active' => 1,
                'score' => [
                    'fail' => 0,
                    'pass' => -5
                ],
                'params' => ''
            ],
            'Country' => [
                'active' => 1,
                'score' => [
                    'fail' => 11,
                    'pass' => 0
                ],
                'params' => 'MX:12|US:15|RU|GB:0,-100',
            ],

            'DifferentCountry' => [
                'active' => 1,
                'score' => [
                    'fail' => 50,
                    'pass' => -10
                ],
                'params' => '',
            ],

            'bot' => [
                'active' => 1,
                'params' => 'sensu'
            ]
        ]
    ]
];
