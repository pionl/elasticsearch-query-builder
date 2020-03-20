<?php

namespace Erichard\ElasticQueryBuilder\Features;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;
use Erichard\ElasticQueryBuilder\Features\HasSorting;

/**
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#request-body-search-inner-hits
 */
class InnerHit implements BuildsArray
{
    use HasSorting, HasCollapse;

    /**
     * The offset from where the first hit to fetch for each inner_hits in the returned regular search hits.
     * @var string|null
     */
    public $from = null;

    /**
     * The maximum number of hits to return per inner_hits. By default the top three matching hits are returned.
     * @var int|null
     */
    public $size = null;

    /**
     * @var string
     */
    public $name;

    /**
     * @param string      $name
     * @param int|null    $size
     * @param string|null $from
     */
    public function __construct(string $name = null,
                                int $size = null,
                                string $from = null)
    {
        $this->from = $from;
        $this->size = $size;
        $this->name = $name;
    }


    public function build(): array
    {
        // Build optional options.  (filter will remove null values)
        $array = array_filter([
            'from' => $this->from,
            'size' => $this->size,
        ]);
        $this->buildSort($array);
        $this->buildCollapse($array);
        return $array;
    }
}
