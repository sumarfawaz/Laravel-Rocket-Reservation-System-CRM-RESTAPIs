<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerLogin;
use Illuminate\Support\Facades\Hash;

class CustomerLoginController extends Controller
{
    // Retrieve all customer logins
    public function index()
    {
        $customerlogins = CustomerLogin::all();
        return response()->json($customerlogins, 200);
    }

    public function create()
    {
        // Code to show form to create a new customer (not needed for API)
    }

    public function store(Request $request)
{
    // Validate the input
    $validator = Validator::make($request->all(), [
        'epassportid' => 'required|string|unique:customers_logins|max:255',
        'password' => 'required|string|max:255',
    ]);

    // Check if the validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Create the customer login (password will be hashed automatically)
    $customerlogin = CustomerLogin::create($request->only(['epassportid', 'password']));

    // Return the success response
    return response()->json([
        'status' => true,
        'message' => 'Account Created Successfully',
        'data' => $customerlogin
    ], 200);
}


    public function verifyPassword(Request $request, $epassportid)
{
    \Log::info('Request data: ', $request->all());

    // Validate the input
    $validator = Validator::make($request->all(), [
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422);
    }

    $customerlogin = CustomerLogin::where('epassportid', $epassportid)->first();

    if (!$customerlogin) {
        return response()->json(['status' => false, 'message' => 'No records found'], 404);
    }

    // Debugging: log the hashed password
    \Log::info('Stored password hash: ' . $customerlogin->password);
    \Log::info('Provided password: ' . $request->password);

    // Compare the provided password with the hashed password
    if (Hash::check(trim($request->password), $customerlogin->password)) {
        return response()->json(['status' => true, 'message' => 'Password is valid.'], 200);
    }
    

    return response()->json(['status' => false, 'message' => 'Invalid password.'], 401);
}


    // Show a specific customer login
    public function show($epassportid)
    {
        $customerlogin = CustomerLogin::where('epassportid', $epassportid)->first();

        if ($customerlogin) {
            return response()->json($customerlogin, 200);
        }

        return response()->json(['status' => false, 'message' => 'No records found'], 404);
    }

    public function edit($id)
    {
        // Code to show form to edit a specific customer (not needed for API)
    }

    // Update a specific customer login
    public function update(Request $request, $epassportid)
    {
        $customerlogin = CustomerLogin::where('epassportid', $epassportid)->first();

        if (!$customerlogin) {
            return response()->json(['status' => false, 'message' => 'No records found'], 404);
        }

        // Validate the input
        $validator = Validator::make($request->all(), [
            'password' => 'nullable|string|max:255', // Make password optional for update
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update the password if provided
        if ($request->has('password')) {
            $customerlogin->password = bcrypt($request->password);
        }

        $customerlogin->save();

        return response()->json(['status' => true, 'message' => 'Account Updated Successfully'], 200);
    }

    // Delete a specific customer login
    public function destroy($epassportid)
    {
        $customerlogin = CustomerLogin::where('epassportid', $epassportid)->firstOrFail();

        $customerlogin->delete();

        return response()->json([
            'status' => true,
            'message' => 'Account Deleted Successfully'
        ], 200);
    }
}
