<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    // Protected property to store all customers
    protected $customers;

    // Constructor to fetch customers once
    public function __construct()
    {
        // Fetch all customers when the controller is instantiated
        $this->customers = Customer::all();
    }

    // Method to get customer analytics by nationality
    public function getCustomerAnalyticsByNationality()
    {
        // Check if there are customers
        if ($this->customers->isEmpty()) {
            return response()->json(['message' => 'No customers found'], 404);
        }

        // Group customers by nationality
        $nationalities = $this->customers->groupBy('nationality');

        // Prepare an associative array where nationality is the key and count is the value
        $analyticsData = $nationalities->mapWithKeys(function ($group, $key) {
            return [$key => count($group)]; // Key is nationality, value is the count
        });

        // Return the data as JSON
        return response()->json($analyticsData);
    }

    // You can add more methods that reuse the $this->customers property
    public function getCustomerCount()
    {
        // Simply return the total number of customers
        return response()->json(['total_customers' => $this->customers->count()]);
    }
}
