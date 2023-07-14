<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Support\Collection;

class LocationSearchService
{
    /**
     * The radius of the Earth.
     *
     * @var int
     */
    protected $earthRadius = 6371;

    /**
     * Search for locations within a given radius of a point.
     *
     * @param  float  $latitude
     * @param  float  $longitude
     * @param  float  $radius
     * @return Collection
     */
    public function search($latitude, $longitude, $radius)
    {
        // Get all locations.
        $locations = Location::all();

        // Filter the locations based on the distance.
        return $locations->filter(function ($location) use ($latitude, $longitude, $radius) {
            $distance = $this->getDistance(
                $latitude,
                $longitude,
                $location->latitude,
                $location->longitude
            );

            // If the distance is less than or equal to the radius, the location is within the radius.
            return $distance <= $radius;
        });
    }

    /**
     * Calculate the distance between two points using the Haversine formula.
     *
     * @param  float  $latitudeFrom
     * @param  float  $longitudeFrom
     * @param  float  $latitudeTo
     * @param  float  $longitudeTo
     * @return float
     */
    protected function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $latDelta = $this->degreesToRadians($latitudeTo - $latitudeFrom);
        $lonDelta = $this->degreesToRadians($longitudeTo - $longitudeFrom);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($this->degreesToRadians($latitudeFrom)) * cos($this->degreesToRadians($latitudeTo)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $this->earthRadius * $c;
    }

    /**
     * Convert degrees to radians.
     *
     * @param  float  $degrees
     * @return float
     */
    protected function degreesToRadians($degrees)
    {
        return $degrees * (pi() / 180);
    }
}
