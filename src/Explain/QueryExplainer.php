<?php

namespace Varunazad\Quicksilver\Explain;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class QueryExplainer
{
    public function __construct(protected ConnectionInterface $connection) {}

    public function analyze(Builder $query): array
    {
        if (!config('quicksilver.explain.enabled')) {
            return [];
        }

        $sql = $query->toSql();
        $bindings = $query->getBindings();

        $explanation = $this->connection->select(
            "EXPLAIN ".$sql, $bindings
        );

        if ($this->isSlowQuery($explanation)) {
            Log::warning('Slow query detected', [
                'sql' => $sql,
                'explanation' => $explanation
            ]);
        }

        return $explanation;
    }

    protected function isSlowQuery(array $explanation): bool
    {
        // Implement your slow query detection logic
        return false;
    }
}