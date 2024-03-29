<?php

$apiVersionKey = 'ApiVersion';
$apiVersionParam =  [
    'required' => false,
    'type'     => 'string',
    'location' => 'uri',
    'default' => 'v1',
];

/*
 * Define Kpi model parameters for reuse
 */
$keyParameters = [
    'id' => [
        'type' => 'string',
        'location' => 'uri',
        'required' => true,
    ],
    'createdAt' => [
        'type' => 'integer',
        'format' => 'date-time',
        'location' => 'json',
        'required' => false,
    ],
    'updatedAt' => [
        'type' => 'integer',
        'format' => 'date-time',
        'location' => 'json',
        'required' => false,
    ],
    'sharedSecret' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
    ],
    'qpd' => [
        'type' => 'integer',
        'location' => 'json',
        'required' => false,
    ],
    'qpm' => [
        'type' => 'integer',
        'location' => 'json',
        'required' => false,
    ],
    'qps' => [
        'type' => 'integer',
        'location' => 'json',
        'required' => false,
    ],
    'forApis' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
    ],
    'disabled' => [
        'type' => 'boolean',
        'location' => 'json',
        'required' => false,
    ],
    'apiLimits' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
    ],
    'allApis' => [
        'type' => 'boolean',
        'location' => 'json',
        'required' => false,
    ],
];

return [
    'operations' => [
        'List' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keys',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'from' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'to' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'resolve' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query'
                ]
            ]
        ],

        'ListAllKeysStats' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keys/all',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'from' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'to' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'granularity' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['second', 'minute', 'hour', 'day']
                ],
                'format_timeseries' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query',
                ],
                'format_timestamp' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['epoch_seconds', 'epoch_milliseconds', 'ISO'],
                ],
            ]
        ],

        'ListAllKeysCharts' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keys/charts',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'granularity' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['second', 'minute', 'hour', 'day']
                ],
            ]
        ],

        'Delete' => [
            'httpMethod' => 'DELETE',
            'uri' => '/{ApiVersion}/key/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'Get' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/key/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'Create' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/key/{id}',
            'responseModel' => 'Generic',
            'parameters' => array_merge(
                [$apiVersionKey => $apiVersionParam],
                $keyParameters
            ),
        ],

        'Update' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/key/{id}',
            'responseModel' => 'Generic',
            'parameters' => array_merge(
                [$apiVersionKey => $apiVersionParam],
                $keyParameters
            ),
        ],

        'GetApiCharts' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/key/{id}/apicharts',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'granularity' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['second', 'minute', 'hour', 'day']
                ],
            ]
        ],

        'ListApis' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/key/{id}/apis',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'resolve' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query',
                ],
            ]
        ],

        'GetStats' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/key/{id}/stats',
            'responseModel' => 'Generic',
            'parameters' => [
                $apiVersionKey => $apiVersionParam,
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'from' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'to' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'granularity' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['second', 'minute', 'hour', 'day']
                ],
                'format_timeseries' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query',
                ],
                'format_timestamp' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['epoch_seconds', 'epoch_milliseconds', 'ISO'],
                ],
                'forapi' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ]
            ]
        ],

    ],
];