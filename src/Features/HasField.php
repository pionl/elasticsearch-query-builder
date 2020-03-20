<?php

namespace Erichard\ElasticQueryBuilder\Features;

trait HasField
{
    /**
     * @var string|null
     */
    public $field = null;

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }
}
