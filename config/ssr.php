<?php

use function Roots\env;

return [
    /*
     * Enable or disable the server renderer. Enabled in production by default.
     */
    'enabled' => defined('WP_ENV') && WP_ENV === 'production',

    /*
     * When server side rendering goes wrong, nothing will be rendered so the
     * client script can render everything from scratch without errors. If
     * `debug` is enabled, an exception will be thrown when the JavaScript can't
     * be executed.
     */
    'debug' => defined('WP_ENV') && WP_ENV === 'development',

    /*
     * The engine class is used to execute JavaScript. Node requires you to set
     * up some extra configuration below. If you want to use the V8 engine, make
     * sure the v8js php extension is available.
     */
    'engine' => env('SSR_ENGINE', \TinyPixel\SSR\Engines\Node::class),

    /*
     * Extra setup for the Node engine.
     */
    'node' => [
        'node_path' => env('NODE_PATH', '/usr/bin/node'),
        'temp_path' => env('NODE_TEMP_PATH', get_theme_file_path('storage/framework/cache/node')),
    ],

    /*
     * Context is used to pass data to the server script. Fill this array with
     * data you *always* want to send to the server script. Context can contain
     * anything that's json serializable.
     */
    'context' => [],

    /*
     * Env is used to fill `process.env` when the server script is executed.
     * Fill this array with data you *always* want to send to the server script.
     * The env array is only allowed to be a single level deep, and can only
     * contain primitive values like numbers, strings or booleans.
     *
     * By default, env is prefilled with some necessary values for server side
     * rendering Vue applications.
     */
    'env' => [
        'NODE_ENV' => 'production',
    ],
];
