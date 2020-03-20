<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\Features\HasField;
use Erichard\ElasticQueryBuilder\QueryException;

class MatchFilter extends Filter
{
    use HasField;

    protected $query;
    protected $analyzer;


    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function setAnalyzer($analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->query) {
            throw new QueryException('You need to call setQuery() on'.__CLASS__);
        }

        $query = [
            'match' => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if (null !== $this->analyzer) {
            $query['match'][$this->field]['analyzer'] = $this->analyzer;
        }

        return $query;
    }
}
