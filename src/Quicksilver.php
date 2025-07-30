<?php

namespace Varunazad\Quicksilver;

use Varunazad\Quicksilver\Cache\QueryCache;
use Varunazad\Quicksilver\Chunk\ChunkOptimizer;
use Varunazad\Quicksilver\EagerLoad\EagerLoadOptimizer;
use Varunazad\Quicksilver\Explain\QueryExplainer;
use Varunazad\Quicksilver\IndexAdvisor\IndexAdvisor;
use Varunazad\Quicksilver\Memory\MemoryProfiler;

class Quicksilver
{
    protected $queryCache;
    protected $chunkOptimizer;
    protected $eagerLoadOptimizer;
    protected $queryExplainer;
    protected $indexAdvisor;
    protected $memoryProfiler;
    public function __construct(
        QueryCache $queryCache,
        ChunkOptimizer $chunkOptimizer,
        EagerLoadOptimizer $eagerLoadOptimizer,
        QueryExplainer $queryExplainer,
        IndexAdvisor $indexAdvisor,
        MemoryProfiler $memoryProfiler
    ) {}

    public function cache(): QueryCache
    {
        return $this->queryCache;
    }

    
    public function cacheQuery($query, $key, $ttl = 60)
    {
        return $this->queryCache->handle($query, $key, $ttl);
    }

    public function chunk(): ChunkOptimizer
    {
        return $this->chunkOptimizer;
    }

    public function eagerLoad(): EagerLoadOptimizer
    {
        return $this->eagerLoadOptimizer;
    }

    public function explain(): QueryExplainer
    {
        return $this->queryExplainer;
    }

    public function index(): IndexAdvisor
    {
        return $this->indexAdvisor;
    }

    public function memory(): MemoryProfiler
    {
        return $this->memoryProfiler;
    }
}
