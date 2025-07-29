<?php

namespace Varun\Quicksilver;

use Illuminate\Support\ServiceProvider;
use Varun\Quicksilver\Cache\QueryCache;
use Varun\Quicksilver\Chunk\ChunkOptimizer;
use Varun\Quicksilver\EagerLoad\EagerLoadOptimizer;
use Varun\Quicksilver\Explain\QueryExplainer;
use Varun\Quicksilver\IndexAdvisor\IndexAdvisor;
use Varun\Quicksilver\Memory\MemoryProfiler;

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
        \Illuminate\Database\Query\Builder::mixin(new \Varun\Quicksilver\Cache\QueryCacheMacro);
        \Illuminate\Database\Eloquent\Builder::mixin(new \Varun\Quicksilver\Cache\QueryCacheMacro);
    }
}