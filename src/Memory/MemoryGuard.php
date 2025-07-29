<?php

namespace Varunazad\Quicksilver\Memory;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class MemoryGuard
{
    public function monitor(Builder $query, ?int $threshold = null): Builder
    {
        $threshold = $threshold ?? config('quicksilver.memory.warning_threshold_mb');

        return $query->tap(function ($results) use ($threshold) {
            $memory = memory_get_usage() / 1024 / 1024;
            if ($memory > $threshold) {
                Log::warning("Query memory threshold exceeded: {$memory}MB");
            }
        });
    }
}