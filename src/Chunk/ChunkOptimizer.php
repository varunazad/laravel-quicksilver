<?php

namespace Varun\Quicksilver\Chunk;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\LazyCollection;

class ChunkOptimizer
{
    public function chunkOptimized(Builder $query, int $size, callable $callback)
    {
        $page = 1;
        
        do {
            $results = $query->forPage($page, $size)->get();
            $count = $results->count();

            if ($count === 0) break;

            $callback($results);
            unset($results);

            $page++;
        } while ($count === $size);
    }

    public function cursorOptimized(Builder $query): LazyCollection
    {
        return $query->cursor();
    }
}