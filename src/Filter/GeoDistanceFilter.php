<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\Features\HasField;

class GeoDistanceFilter extends Filter
{
    use HasField;

    protected $distance;
    protected $pinLocation;

    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    public function setPinLocation($pinLocation)
    {
        $this->pinLocation = $pinLocation;

        return $this;
    }

    public function build(): array
    {
        return [
            'geo_distance' => [
                'distance' => $this->distance,
                $this->field ? $this->field : 'geolocation' => $this->pinLocation,
            ],
        ];
    }
}
