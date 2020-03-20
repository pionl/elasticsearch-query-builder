<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\QueryException;

class MinAggregation extends AbstractMaxMinAggregation
{
    protected function key(): string
    {
        return 'min';
    }
}
