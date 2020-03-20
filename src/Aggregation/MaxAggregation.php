<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class MaxAggregation extends AbstractMaxMinAggregation
{
    protected function key(): string
    {
        return 'max';
    }
}
