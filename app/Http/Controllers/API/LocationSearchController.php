<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationSearchRequest;
use App\Services\LocationSearchService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


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
    public function search(Request $request): JsonResponse
    {
        // Refactor: Move this into it's own validations Request class,
        // as of the moment not sure yet why the LocationSearchRequest was not
        // triggering the validations and it just return to home page.
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
        ]);

        // Validate the request data
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius;

        // Pass the latitude, longitude, and radius to the search service
        $results = $this->searchService->search($latitude, $longitude, $radius);

        return response()->json($results);

    }
}
