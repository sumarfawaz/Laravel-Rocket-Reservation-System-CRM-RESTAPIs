<?php

namespace App\Http\Controllers;

use App\Models\Rocket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RocketController extends Controller
{
    public function index()
    {
        $rockets = Rocket::all();
        return response()->json([
            'status' => true,
            'message' => 'Rockets retrieved successfully',
            'data' => $rockets
        ], 200);
    }

    public function show($rocketname)
    {
        // Fetch Rocket by Rocket_Name
        $rockets = Rocket::where('rocketname', $rocketname)-> first();

        if($rockets){
            return response()->json($rockets, 200);
        }

        return response()->json(['message' => 'Rocket not found'], 404);

    }


    public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'rocketname' => 'required|string|unique:rockets|max:255',
                'height' => 'required|integer|min:0', // numeric to accept decimal values
                'diameter' => 'required|integer|min:0', // numeric for decimal values
                'mass' => 'required|integer|min:0', // assuming mass is a positive integer
                'payloadtoleo' => 'required|integer|min:0', // integer values for payload
                'payloadtogto' => 'required|integer|min:0',
                'payloadtomars' => 'required|integer|min:0',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $rockets = Rocket::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Rocket created successfully',
                'data' => $rockets
            ], 201);


        }

        public function update(Request $request, $rocketname)
        {
            $rocket = Rocket::where('rocketname', $rocketname)->firstOrFail();

            $validator = Validator::make($request->all(), [
                'rocketname' => 'sometimes|string|unique:rockets,rocketname,'.$rocket->id.'|max:255',
                'height' => 'sometimes|integer|min:0', // numeric to accept decimal values
                'diameter' => 'sometimes|integer|min:0', // numeric for decimal values
                'mass' => 'sometimes|integer|min:0', // assuming mass is a positive integer
                'payloadtoleo' => 'sometimes|integer|min:0', // integer values for payload
                'payloadtogto' => 'sometimes|integer|min:0',
                'payloadtomars' => 'sometimes|integer|min:0',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Update the customer record with the validated data
            $rocket->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Customer updated successfully',
                'data' => $rocket
            ], 200);
        }

        public function destroy($rocketname)
        {
            // Find the customer by epassportid
            $rocket = Rocket::where('rocketname', $rocketname)->firstOrFail();
            
            // Delete the customer
            $rocket->delete();

            // Return success response with 200 status to show the message
            return response()->json([
                'status' => true,
                'message' => 'Rocket deleted successfully'
            ], 200);
        }

}
