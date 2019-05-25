<?php
return [
            'Detection' => [
                'Rules' => [
                    'html' => [
                        'active' => 1,
                        'score' => '46',
                        'params' => ''
                    ],
                    'DisposableEmail' => [
                        'active' => 1,
                        'score' => '46',
                        'params' => ''
                    ],
                    'Country' => [
                        'active' => 1,
                        'score' => 11,
                        'params' => 'MX:12|US:15|RU',
                    ],
                    'DifferentCountry' => [
                        'active' => 1,
                        'score' => 50,
                        'params' => '',
                    ],
                    'bot' => [
                        'active' => 1,
                        'params' => 'sensu'
                    ]
                ]
            ]
        ];
