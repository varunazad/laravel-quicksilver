<?php

namespace Varun\Quicksilver\Cache;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;

class QueryCache
{
    public function __construct(protected Repository $cache) {}

    public function remember(Builder $query, ?int $ttl = null, array $tags = [])
    {
        $key = $this->getCacheKey($query);
        $ttl = $ttl ?? config('quicksilver.cache.default_ttl');
        
        return $this->cache->tags($tags)->remember($key, $ttl, fn() => $query->get());
    }

    protected function getCacheKey(Builder $query): string
    {
        return md5(vsprintf('%s.%s.%s', [
            $query->toSql(),
            json_encode($query->getBindings()),
            $query->getConnection()->getName(),
        ]));
    }
}