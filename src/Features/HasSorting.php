<?php

namespace Erichard\ElasticQueryBuilder\Features;

trait HasSorting
{
    /**
     * @var array|array[]|string[]
     */
    protected $sort = [];

    /**
     * Adds sort.
     *
     * @param string       $field
     * @param array|string $config Can be order direction ('desc') or config (['order' => 'asc']]
     *
     * @return $this
     */
    public function addSort(string $field, $config = 'asc')
    {
        $this->sort[$field] = $config;

        return $this;
    }

    /**
     * Adds sort settings to array if sorting was set..
     *
     * @param array $toArray
     */
    protected function buildSort(array &$toArray)
    {
        if (!empty($this->sort)) {
            foreach ($this->sort as $sort => $config) {
                $toArray['sort'][$sort] = $config;
            }
        }
    }
}
