<?php

namespace Erichard\ElasticQueryBuilder\Features;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;
use Erichard\ElasticQueryBuilder\Features\HasField;
use Erichard\ElasticQueryBuilder\Features\InnerHit;

/**
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#_expand_collapse_results
 */
class Collapse implements BuildsArray
{
    use HasField;

    /**
     * @var array|InnerHit[]
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#request-body-search-inner-hits
     */
    protected $innerHits = [];

    /**
     * The number of concurrent requests allowed to retrieve the inner_hits` per group
     * @var int|null
     */
    protected $maxConcurrentSearchers = null;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function addInnerHit(InnerHit $hit): self
    {
        $this->innerHits[] = $hit;

        return $this;
    }

    public function build(): array
    {
        $result = [
            'field' => $this->field,
        ];

        if (null !== $this->maxConcurrentSearchers) {
            $result['max_concurrent_group_searches'] = $this->maxConcurrentSearchers;
        }

        if (false === empty($this->innerHits)) {
            $result['inner_hits'] = array_map(function (InnerHit $hit) {
                return $hit->build();
            }, $this->innerHits);
        }

        return $result;
    }

    public function setMaxConcurrentSearchers(int $maxConcurrentSearchers): self
    {
        $this->maxConcurrentSearchers = $maxConcurrentSearchers;

        return $this;
    }
}
