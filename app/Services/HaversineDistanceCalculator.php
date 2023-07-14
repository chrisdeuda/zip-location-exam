<?php

namespace App\Services;

/**
 * Class HaversineDistanceCalculator
 * Calculates the distance between two points using the Haversine formula.
 */
class HaversineDistanceCalculator implements DistanceCalculatorInterface
{
    /**
     * The radius of the Earth in kilometers.
     */
    private const EARTH_RADIUS = 6371;

    /**
     * Calculate the distance between two points using the Haversine formula.
     *
     * @param float $latitudeFrom    Latitude of the starting point.
     * @param float $longitudeFrom   Longitude of the starting point.
     * @param float $latitudeTo      Latitude of the destination point.
     * @param float $longitudeTo     Longitude of the destination point.
     * @return float                 The calculated distance.
     */
    public function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $latDelta = $this->degreesToRadians($latitudeTo - $latitudeFrom);
        $lonDelta = $this->degreesToRadians($longitudeTo - $longitudeFrom);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($this->degreesToRadians($latitudeFrom)) * cos($this->degreesToRadians($latitudeTo)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return self::EARTH_RADIUS * $c;
    }

    /**
     * Convert degrees to radians.
     *
     * @param float $degrees    The value in degrees.
     * @return float            The value converted to radians.
     */
    protected function degreesToRadians($degrees)
    {
        return $degrees * (pi() / 180);
    }
}
