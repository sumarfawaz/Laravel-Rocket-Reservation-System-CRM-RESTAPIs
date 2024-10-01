<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpaceStation;
use Illuminate\Support\Facades\Validator;

class SpaceStationController extends Controller
{
    public function index(){
        $spacestations = SpaceStation::all();
        return response()->json([
            'status' => true,
            'message' => 'Space Stations retrieved successfully',
            'data' => $spacestations
        ], 200);
    }

    public function show($spacestation_name){
        // Fetch Space Station by Space Station Name
        $spacestations = SpaceStation::where('spacestation_name', $spacestation_name)->first();

        if($spacestations){
            return response()->json($spacestations, 200);
        }

        return response()->json(['message' => 'Space Station not found'], 404);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'spacestation_name' => 'required|string|unique:space_stations|max:255',
            'spacestation_location' => 'required|string',
            'distance_from_earth' => 'required|string',
            'time_at_space_station' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $spacestations = SpaceStation::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Space Station created successfully',
            'data' => $spacestations
        ], 201);
    }

    public function update(Request $request, $spacestation_name)
{
    // Fetch the current space station by name
    $spacestation = SpaceStation::where('spacestation_name', $spacestation_name)->first();

    if (!$spacestation) {
        return response()->json([
            'status' => false,
            'message' => 'Space Station not found'
        ], 404);
    }

    // Validate input and ensure spacestation_name is unique except for the current one
    $validator = Validator::make($request->all(), [
        'spacestation_name' => 'required|string|unique:space_stations,spacestation_name,' . $spacestation->id, // Ignore the current spacestation
        'spacestation_location' => 'required|string',
        'distance_from_earth' => 'required|string',
        'time_at_space_station' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Update the space station with the validated data
    $spacestation->update($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Space Station updated successfully',
        'data' => $spacestation
    ], 200);
}


    public function destroy($spacestation_name){
        $spacestations = SpaceStation::where('spacestation_name', $spacestation_name)->first();

        if($spacestations){
            $spacestations->delete();
            return response()->json([
                'status' => true,
                'message' => 'Space Station deleted successfully'
            ], 200);
        }

        return response()->json(['message' => 'Space Station not found'], 404);
    }
}
