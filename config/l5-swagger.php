<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'Homebrewing Storage Swagger UI',
            ],
            'routes' => [
                'api' => 'api/documentation',
            ],
            'paths' => [
                'docs_json' => 'api-docs.json',
                'docs_yaml' => 'api-docs.yaml',
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],
    'defaults' => [
        'routes' => [
            'docs' => 'docs',
            'oauth2_callback' => 'api/oauth2-callback',
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],
            'group_options' => [],
        ],

        'paths' => [
            'docs' => storage_path('api-docs'),
            'views' => base_path('resources/views/vendor/l5-swagger'),
            'base' => env('L5_SWAGGER_BASE_PATH', null),
            'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),
            'excludes' => [],
        ],

        'securityDefinitions' => [
            'securitySchemes' => [
                /*
                 * Examples of Security schemes
                */
                /*
                'api_key_security_example' => [ // Unique name of security
                    'type' => 'apiKey', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'A short description for security scheme',
                    'name' => 'api_key', // The name of the header or query parameter to be used.
                    'in' => 'header', // The location of the API key. Valid values are "query" or "header".
                ],
                'oauth2_security_example' => [ // Unique name of security
                    'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'A short description for oauth2 security scheme.',
                    'flow' => 'implicit', // The flow used by the OAuth2 security scheme. Valid values are "implicit", "password", "application" or "accessCode".
                    'authorizationUrl' => 'http://example.com/auth', // The authorization URL to be used for (implicit/accessCode)
                    //'tokenUrl' => 'http://example.com/auth' // The authorization URL to be used for (password/application/accessCode)
                    'scopes' => [
                        'read:projects' => 'read your projects',
                        'write:projects' => 'modify projects in your account',
                    ]
                ],
                */

                /* Open API 3.0 support
                'passport' => [ // Unique name of security
                    'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'Laravel passport oauth2 security.',
                    'in' => 'header',
                    'scheme' => 'https',
                    'flows' => [
                        "password" => [
                            "authorizationUrl" => config('app.url') . '/oauth/authorize',
                            "tokenUrl" => config('app.url') . '/oauth/token',
                            "refreshUrl" => config('app.url') . '/token/refresh',
                            "scopes" => []
                        ],
                    ],
                ],
                */
            ],
            'security' => [
                /*
                 * Examples of Securities
                */
                [
                    /*
                    'oauth2_security_example' => [
                        'read',
                        'write'
                    ],

                    'passport' => []
                    */
                ],
            ],
        ],
        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),
        'proxy' => false,
        'additional_config_url' => null,
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),
        'validator_url' => null,

        /*
         * Uncomment to add constants which can be used in annotations
         */
        // 'constants' => [
        // 'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://my-default-host.com'),
        // ],
    ],
];
