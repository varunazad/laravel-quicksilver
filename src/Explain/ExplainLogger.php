<?php

namespace Varun\Quicksilver\Explain;

use Illuminate\Support\Facades\Log;

class ExplainLogger
{
    public function log(string $query, array $explanation)
    {
        Log::channel(config('quicksilver.explain.log_channel'))
            ->debug('Query Explanation', [
                'query' => $query,
                'explanation' => $explanation
            ]);
    }
}