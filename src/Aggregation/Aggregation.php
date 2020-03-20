<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;

abstract class Aggregation implements BuildsArray
{
    private $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function terms($name = null)
    {
        return new TermsAggregation($name);
    }

    public static function nested($name = null)
    {
        return new NestedAggregation($name);
    }

    public static function reverseNested($name = null)
    {
        return new ReverseNestedAggregation($name);
    }

    public static function filter($name = null)
    {
        return new FilterAggregation($name);
    }

    public static function max($name = null)
    {
        return new MaxAggregation($name);
    }

    public static function min($name = null)
    {
        return new MinAggregation($name);
    }

    public static function topHits($name = null)
    {
        return new TopHitsAggregation($name);
    }
}
