<?php

namespace Varunazad\Quicksilver\EagerLoad;

use Illuminate\Database\Eloquent\Builder;

class EagerLoadOptimizer
{
    public function optimize(Builder $query, array $relations): Builder
    {
        return $query->with($this->prepareRelations($relations));
    }

    protected function prepareRelations(array $relations): array
    {
        return array_map(function ($relation) {
            if (str_contains($relation, ':')) {
                [$relation, $limit] = explode(':', $relation);
                return fn($q) => $q->limit((int) $limit);
            }
            return $relation;
        }, $relations);
    }
}