<?php

namespace Erichard\ElasticQueryBuilder\Features;

trait HasCollapse
{
    /**
     * @var Collapse|null
     */
    protected $collapse = null;

    /**
     * Adds field collapsing.
     *
     * @param string|Collapse $collapseByField Collapse by given field or provide collapse object.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#request-body-search-collapse
     */
    public function collapse($collapseByField)
    {
        $this->collapse = is_string($collapseByField)
            ? new Collapse($collapseByField)
            : $collapseByField;
    }

    /**
     * Adds collapse to array if field collapsing is set.
     *
     * @param array $toArray
     */
    public function buildCollapse(array &$toArray)
    {
        if (null !== $this->collapse) {
            $toArray['collapse'] = $this->collapse->build();
        }
    }
}
