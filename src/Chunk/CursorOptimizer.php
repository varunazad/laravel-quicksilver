<?php

namespace Varun\Quicksilver\Chunk;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\LazyCollection;

class CursorOptimizer
{
    public function optimize(Builder $query): LazyCollection
    {
        return $query->cursor()
            ->remember() // Optional caching
            ->filter()  // Add your optimizations
            ->map(function ($item) {
                // Process items one by one
                return $item;
            });
    }
}