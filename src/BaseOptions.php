<?php

namespace devtoolboxuk\cerberus;

class BaseOptions
{

    public function getOptions()
    {
        if ($this->isYamlLoaded()) {
            return yaml_parse_file(__DIR__ . '/Options.yml');
        }

        return [
            'Detection' => [
                'Rules' => [
                    'Bots' => [
                        'active' => 1,
                        'score' => 1,
                        'params' => 'sensu'
                    ],
                    'Html' => [
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

    private function isYamlLoaded()
    {
        return extension_loaded('yaml');
    }
}