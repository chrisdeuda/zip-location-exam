<?php

namespace App\Services;

interface DistanceCalculatorInterface
{
    public function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
}
