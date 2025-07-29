<?php

namespace Varun\Quicksilver;

use Varun\Quicksilver\Cache\QueryCache;
use Varun\Quicksilver\Chunk\ChunkOptimizer;
use Varun\Quicksilver\EagerLoad\EagerLoadOptimizer;
use Varun\Quicksilver\Explain\QueryExplainer;
use Varun\Quicksilver\IndexAdvisor\IndexAdvisor;
use Varun\Quicksilver\Memory\MemoryProfiler;

class Quicksilver
{
    public function __construct(
        protected QueryCache $queryCache,
        protected ChunkOptimizer $chunkOptimizer,
        protected EagerLoadOptimizer $eagerLoadOptimizer,
        protected QueryExplainer $queryExplainer,
        protected IndexAdvisor $indexAdvisor,
        protected MemoryProfiler $memoryProfiler
    ) {}

    public function cache(): QueryCache
    {
        return $this->queryCache;
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