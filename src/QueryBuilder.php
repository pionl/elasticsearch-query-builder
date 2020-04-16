<?php

namespace Erichard\ElasticQueryBuilder;

use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;
use Erichard\ElasticQueryBuilder\Features\Collapse;
use Erichard\ElasticQueryBuilder\Features\HasCollapse;
use Erichard\ElasticQueryBuilder\Features\HasSorting;
use Erichard\ElasticQueryBuilder\Filter\Filter;

class QueryBuilder
{
    use HasSorting, HasCollapse;

    /**
     * @var array
     */
    private $query;

    /**
     * @var array
     */
    private $aggregations = [];

    /**
     * @var Filter
     */
    private $filter = null;

    /**
     * @var Filter
     */
    private $postFilter;

    public function __construct(array $query = [])
    {
        $this->query = $query;
    }

    public function setSource($source)
    {
        $this->query['_source'] = $source;

        return $this;
    }

    public function setType($type)
    {
        $this->query['type'] = $type;

        return $this;
    }

    public function setIndex($index)
    {
        $this->query['index'] = $index;

        return $this;
    }

    public function setFrom($from)
    {
        $this->query['from'] = $from;

        return $this;
    }

    public function setSize($size)
    {
        $this->query['size'] = $size;

        return $this;
    }

    public function addAggregation(Aggregation $aggregation)
    {
        $this->aggregations[] = $aggregation;

        return $this;
    }

    public function addFilter(Filter $filter)
    {
        $this->filter = $filter;

        return $this;
    }

    public function setPostFilter(Filter $filter)
    {
        $this->postFilter = $filter;
    }

    public function getQuery()
    {
        $query = $this->query;

        // Ensure that query can built even if no filter/aggregations are used.
        if (!isset($query['body'])) {
            $query['body'] = [];
        }

        if (!empty($this->aggregations)) {
            $query['body']['aggs'] = [];
            foreach ($this->aggregations as $aggregation) {
                $query['body']['aggs'][$aggregation->getName()] = $aggregation->build();
            }
        }

        if (null !== $this->filter) {
            $query['body']['query'] = $this->filter->build();
        }

        if (null !== $this->postFilter) {
            $query['body']['post_filter'] = $this->postFilter->build();
        }

        $this->buildSort($query['body']);
        $this->buildCollapse($query['body']);

        return $query;
    }
}
