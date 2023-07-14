<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LocationSearchService;
use App\Tasks\Tasks\Services\TaskSearchService;
use Illuminate\Http\Request;

class LocationSearchController extends Controller
{
    private LocationSearchService $searchService;
    public function __construct(LocationSearchService $searchService)
    {
        $this->searchService = $searchService;

    }

    /**
     * Display search for location
     */
    public function search(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius');

        // Pass the latitude, longitude, and radius to the search service
        $results = $this->searchService->search($latitude, $longitude, $radius);

        return response()->json($results);


    }


}
