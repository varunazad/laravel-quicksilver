<?php

namespace Varunazad\Quicksilver;

use Illuminate\Support\ServiceProvider;
use Varunazad\Quicksilver\Cache\QueryCache;
use Varunazad\Quicksilver\Chunk\ChunkOptimizer;
use Varunazad\Quicksilver\EagerLoad\EagerLoadOptimizer;
use Varunazad\Quicksilver\Explain\QueryExplainer;
use Varunazad\Quicksilver\IndexAdvisor\IndexAdvisor;
use Varunazad\Quicksilver\Memory\MemoryProfiler;

class QuicksilverServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/quicksilver.php', 'quicksilver'
        );

        $this->app->singleton('quicksilver', function ($app) {
            return new Quicksilver(
                new QueryCache($app['cache']),
                new ChunkOptimizer(),
                new EagerLoadOptimizer(),
                new QueryExplainer($app['db']),
                new IndexAdvisor($app['db']),
                new MemoryProfiler()
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/quicksilver.php' => config_path('quicksilver.php'),
        ], 'quicksilver-config');

        $this->registerMacros();
    }

    protected function registerMacros()
    {
        \Illuminate\Database\Query\Builder::mixin(new \Varunazad\Quicksilver\Cache\QueryCacheMacro);
        \Illuminate\Database\Eloquent\Builder::mixin(new \Varunazad\Quicksilver\Cache\QueryCacheMacro);
    }
}