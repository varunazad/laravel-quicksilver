<?php

namespace Varun\Quicksilver\Memory;

use Illuminate\Support\Facades\Log;

class MemoryProfiler
{
    protected float $startMemory;

    public function start(): void
    {
        $this->startMemory = memory_get_usage();
    }

    public function end(): float
    {
        $usage = memory_get_usage() - $this->startMemory;
        $usageMb = round($usage / 1024 / 1024, 2);

        if ($usageMb > config('quicksilver.memory.warning_threshold_mb')) {
            Log::warning("High memory usage: {$usageMb}MB");
        }

        return $usageMb;
    }

    public function profile(callable $callback): array
    {
        $this->start();
        $result = $callback();
        $memory = $this->end();

        return [
            'result' => $result,
            'memory_used_mb' => $memory
        ];
    }
}