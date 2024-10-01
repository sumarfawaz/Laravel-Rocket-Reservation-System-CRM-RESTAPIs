<?php

namespace App\Http\Controllers;

use App\Models\Scheduler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulerController extends Controller
{
    // Fetch all schedules
    public function index()
    {
        $schedulers = Scheduler::all();
        return response()->json([
            'status' => true,
            'message' => 'Schedules retrieved successfully',
            'data' => $schedulers
        ], 200);
    }

    // Fetch a specific schedule by scheduler_name
    public function show($scheduler_name)
    {
        $scheduler = Scheduler::where('scheduler_name', $scheduler_name)->first();

        if ($scheduler) {
            return response()->json([
                'status' => true,
                'message' => 'Schedule retrieved successfully',
                'data' => $scheduler
            ], 200);
        }

        return response()->json(['message' => 'Schedule not found'], 404);
    }

    // Store a new schedule
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'scheduler_name' => 'required|string|unique:schedulers|max:255', // Updated table name to schedulers
            'rocketname' => 'required|string|exists:rockets,rocketname', // Ensure the rocket exists
            'spacestation_name' => 'required|string|exists:space_stations,spacestation_name', // Ensure the space station exists
            'launch_date_time' => 'required|date',
            'price' => 'required|integer|min:0',
            'passengers' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $scheduler = Scheduler::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Schedule created successfully',
            'data' => $scheduler
        ], 201);
    }

    // Update an existing schedule
    public function update(Request $request, $scheduler_name)
    {
        $scheduler = Scheduler::where('scheduler_name', $scheduler_name)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'rocketname' => 'required|string|exists:rockets,rocketname', // Ensure the rocket exists
            'spacestation_name' => 'required|string|exists:space_stations,spacestation_name', // Ensure the space station exists
            'launch_date_time' => 'required|date',
            'price' => 'required|integer|min:0',
            'passengers' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the schedule
        $scheduler->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Schedule updated successfully',
            'data' => $scheduler
        ], 200);
    }

    // Delete a schedule
    public function destroy($scheduler_name)
    {
        $scheduler = Scheduler::where('scheduler_name', $scheduler_name)->first();

        if ($scheduler) {
            $scheduler->delete();
            return response()->json([
                'status' => true,
                'message' => 'Schedule deleted successfully'
            ], 200);
        }

        return response()->json(['message' => 'Schedule not found'], 404);
    }
}
