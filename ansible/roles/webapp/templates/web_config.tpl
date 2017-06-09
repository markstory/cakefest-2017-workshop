<?php
// This file is managed by ansible.
return [
    'debug' => {{ app.debug }},

    'App' => [
        'namespace' => 'App',
        'encoding' => 'UTF-8',
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        'fullBaseUrl' => 'https://{{ app.hostname }}',
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],

    'Security' => [
        'salt' => '{{ app.hash_salt }}',
    ],

    /**
     * Configure the cache adapters.
     */
    'Cache' => [
        'default' => [
            'className' => 'File',
            'path' => CACHE,
        ],

        /**
         * Configure the cache used for general framework caching.
         * Translation cache files are stored with this configuration.
         */
        '_cake_core_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+2 minutes',
        ],

        /**
         * Configure the cache for model and datasource caches. This cache
         * configuration is used to store schema descriptions, and table listings
         * in connections.
         */
        '_cake_model_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+2 minutes',
        ],
    ],

    'Error' => [
        'errorLevel' => E_ALL & ~E_DEPRECATED & ~E_STRICT,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => [
            'Cake\Network\Exception\UnauthorizedException',
            'Cake\Network\Exception\NotFoundException',
            'Cake\Routing\Exception\MissingRouteException',
            'App\Service\InvalidAccessTokenException',
        ],
        'log' => true,
        'trace' => true,
    ],

    'EmailTransport' => [
        'default' => [
            'className' => 'Mail',
            'additionalParameters' => '-fsupport@{{ app.hostname }}',
        ],
    ],

    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'support@stickler-ci.com',
            'charset' => 'utf-8',
            'headerCharset' => 'utf-8',
        ],
    ],

    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => '{{ mysql.user }}',
            'password' => '{{ mysql.password }}',
            'database' => '{{ mysql.app_database }}',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => false,
        ],

        /**
         * The test connection is used during the test suite.
         */
        'test' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => '{{ mysql.user }}',
            'password' => '{{ mysql.password }}',
            'database' => '{{ mysql.test_database }}',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'log' => false,
        ],
    ],

    /**
     * Configures logging options
     */
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\ConsoleLog',
            'levels' => ['debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\SyslogLog',
            'prefix' => 'workshop',
            'levels' => [
                {%- if app.debug %}
                'notice',
                'info',
                'debug',
                {%- endif %}
                'warning',
                'error',
                'critical',
                'alert',
                'emergency'
            ],
        ],
    ],

    'Session' => [
        'defaults' => 'php',
    ],
];
