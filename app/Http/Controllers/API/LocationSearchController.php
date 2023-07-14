<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationSearchRequest;
use App\Services\LocationSearchService;
use Illuminate\Http\JsonResponse;


class LocationSearchController extends Controller
{
    private LocationSearchService $searchService;

    public function __construct(LocationSearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Display search results for location.
     */
    public function search(LocationSearchRequest $request): JsonResponse
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius;

        // Pass the latitude, longitude, and radius to the search service
        $results = $this->searchService->search($latitude, $longitude, $radius);

        return response()->json($results);

    }
}
