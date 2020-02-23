<?php

use function Roots\app;

if (!function_exists('ssr')) {
    function ssr(string $entry = null)
    {
        if (func_num_args() === 0) {
            return app('ssr');
        }

        return app('ssr')->entry($entry);
    }
}
