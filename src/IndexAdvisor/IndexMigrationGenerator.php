<?php

namespace Varun\Quicksilver\IndexAdvisor;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class IndexMigrationGenerator
{
    public function generate(string $table, array $columns): string
    {
        $indexName = 'idx_'.$table.'_'.implode('_', $columns);
        $stub = $this->getStub();
        
        return str_replace(
            ['{{table}}', '{{columns}}', '{{index}}'],
            [$table, "'".implode("', '", $columns)."'", $indexName],
            $stub
        );
    }

    protected function getStub(): string
    {
        return file_get_contents(__DIR__.'/stubs/index_migration.stub');
    }
}