<?php

namespace TinyPixel\SSR\Providers;

use TinyPixel\SSR\Renderer;
use TinyPixel\SSR\Engines\Engine;
use TinyPixel\SSR\Engines\Node;
use Roots\Acorn\ServiceProvider;

class SSRServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ssr.php' => \Roots\config_path('ssr.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Node::class, function () {
            return new Node(
                $this->app->config->get('ssr.node.node_path'),
                $this->app->config->get('ssr.node.temp_path')
            );
        });

        $this->app->bind(Engine::class, function () {
            return $this->app->make($this->app->config->get('ssr.engine'));
        });

        $this->app->resolving(Renderer::class, function (Renderer $serverRenderer) {
            return $serverRenderer
                ->enabled($this->app->config->get('ssr.enabled'))
                ->debug($this->app->config->get('ssr.debug'))
                ->context('url', get_page_uri())
                ->context($this->app->config->get('ssr.context'))
                ->env($this->app->config->get('ssr.env'));
        });

        $this->app->alias(Renderer::class, 'ssr');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['ssr'];
    }
}
