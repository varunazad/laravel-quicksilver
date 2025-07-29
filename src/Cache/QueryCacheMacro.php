<?php

namespace Varunazad\Quicksilver\Cache;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;

class QueryCacheMacro
{
    public function quicksilverCache()
    {
        return function (?int $ttl = null, array $tags = []) {
            return app('quicksilver')->cache()->remember($this, $ttl, $tags);
        };
    }
}