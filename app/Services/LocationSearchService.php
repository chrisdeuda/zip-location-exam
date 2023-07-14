<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Support\Collection;

class LocationSearchService
{
    protected DistanceCalculatorInterface $distanceCalculator;

    public function __construct(DistanceCalculatorInterface $distanceCalculator)
    {
        $this->distanceCalculator = $distanceCalculator;
    }

    public function search($latitude, $longitude, $radius)
    {
        $locations = Location::all();

        return $locations->filter(function ($location) use ($latitude, $longitude, $radius) {
            $distance = $this->distanceCalculator->getDistance(
                $latitude,
                $longitude,
                $location->latitude,
                $location->longitude
            );

            return $distance <= $radius;
        });
    }
}
