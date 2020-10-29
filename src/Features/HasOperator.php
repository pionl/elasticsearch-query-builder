<?php

namespace Erichard\ElasticQueryBuilder\Features;

trait HasOperator
{
    /**
     * @var string|null
     */
    public $operator = null;

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function buildOperator(array &$array): self
    {
        if ($this->operator === null) {
            return $this;
        }

        $array['operator'] = $this->operator;

        return $this;
    }
}
