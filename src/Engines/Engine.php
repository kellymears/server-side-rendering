<?php

namespace TinyPixel\SSR;

interface Engine
{
    public function run(string $script): string;

    public function getDispatchHandler(): string;
}
