<?php

namespace TinyPixel\SSR\Engines;

interface Engine
{
    public function run(string $script): string;

    public function getDispatchHandler(): string;
}
