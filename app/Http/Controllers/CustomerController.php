<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Fetch all customers
        $title = 'RocketX - Manage Users'; // Define the title

        // Pass customers and title to the manage-users view
        return view('manage-users', compact('customers', 'title')); 
    }

    public function show($epassportid)
    {
          // Fetch customer by epassportid
          $customer = Customer::where('epassportid', $epassportid)->first();

          if ($customer) {
              return response()->json($customer, 200);  // Return the customer if found
          }
  
          return response()->json(['message' => 'Customer not found'], 404);  // Return error if not found
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'epassportid' => 'required|string|unique:customers|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:customers|max:255',
            'email' => 'required|string|email|unique:customers|max:255',
            'age' => 'required|integer|max:255',
            'occcupation' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Customer::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }

    public function update(Request $request, $epassportid)
{
    // Find the customer by epassportid
    $customer = Customer::where('epassportid', $epassportid)->firstOrFail();

    // Validate the incoming data
    $validator = Validator::make($request->all(), [
        'epassportid' => 'string|unique:customers,epassportid,' . $customer->id . '|max:255',  // Ensure the epassportid is unique except for the current customer
        'first_name' => 'sometimes|string|max:255',
        'last_name' => 'sometimes|string|max:255',
        'phone_number' => 'string|unique:customers,phone_number,' . $customer->id . '|max:255',  // Ensure phone number is unique except for the current customer
        'email' => 'sometimes|string|email|unique:customers,email,' . $customer->id . '|max:255',  // Ensure email is unique except for the current customer
        'age' => 'sometimes|integer|max:255',
        'occcupation' => 'sometimes|string|max:255',
        'nationality' => 'sometimes|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Update the customer record with the validated data
    $customer->update($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Customer updated successfully',
        'data' => $customer
    ], 200);
}

    

public function destroy($epassportid)
{
    // Find the customer by epassportid
    $customer = Customer::where('epassportid', $epassportid)->firstOrFail();
    
    // Delete the customer
    $customer->delete();

    // Return success response with 200 status to show the message
    return response()->json([
        'status' => true,
        'message' => 'Customer deleted successfully'
    ], 200);
}

}
